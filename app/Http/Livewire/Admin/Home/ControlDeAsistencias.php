<?php

namespace App\Http\Livewire\Admin\Home;

use App\Models\Assistance;
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

        $asistencias = Check::whereDate('fecha',  $this->fecha)
        // ->where('company_id', $this->company)
        ->count();

        $faltaron = Assistance::where('asistencia', 'No asistió')->whereDate('created_at', $this->fecha)->count();


        // $faltaron = User::where('company_id', $this->company)->whereHas('assistances', function($query) {
        //     $query->where('asistencia', '=', 'No asistió')->whereHas('check', function($query) {
        //         $query->whereDate('fecha', $this->fecha);
        //     });
        // })
        // ->count();

        $justificaciones = 0;

        return view('livewire.admin.home.control-de-asistencias', [
            'companies' => $companies,
            'compañia' => $compañia,
            'empleados' => $empleados,
            'asistencias' => $asistencias,
            'faltaron' => $faltaron,
            'justificaciones' => $justificaciones
        ]);
    }
}
