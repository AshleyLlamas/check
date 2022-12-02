<?php

namespace App\Http\Livewire\Admin\Home;

use App\Models\Check;
use App\Models\Company;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class ControlDeAsistencias extends Component
{
    public $fecha, $company;

    public function __construct(){
        $this->fecha = Carbon::now()->formatLocalized('%Y-%m-%d');
        $this->company = 1;
    }

    public function render()
    {
        $companies = Company::orderBy('nombre_de_la_compañia')->get();

        $compañia = Company::where('id', $this->company)->first()->nombre_de_la_compañia;

        $empleados = User::where('company_id', $this->company)->count();
        $asistencias = Check::where('fecha', $this->fecha)->where('company_id', $this->company)->count();
        //$con_retardo = Check::where('fecha', $this->fecha)->where('company_id', $this->company)->join('time_checks', 'checks.id', '=', 'time_checks.id')->where('estatus', 'Llego tarde')->count();
        $con_retardo = Check::where('company_id', $this->company)->whereHas('in', function($query) {
            $query->where('estatus', '=', 'Llego tarde');
        })
        ->count();
        //$faltaron = Check::where('fecha', $this->fecha)->where('company_id', $this->company)->join('assistances', 'checks.id', '=', 'assistances.id')->where('asistencia', 'Inasistencia')->count();
        $faltaron = User::where('company_id', $this->company)->whereHas('assistances', function($query) {
            $query->where('asistencia', '=', 'No asistió');
        })
        ->count();

        return view('livewire.admin.home.control-de-asistencias', [
            'companies' => $companies,
            'compañia' => $compañia,
            'empleados' => $empleados,
            'asistencias' => $asistencias,
            'con_retardo' => $con_retardo,
            'faltaron' => $faltaron
        ]);
    }
}
