<?php

namespace App\Http\Livewire\Admin\Home;

use App\Models\Assistance;
use App\Models\Check;
use App\Models\Company;
use App\Models\JustifyAttendance;
use App\Models\User;
use App\Models\Vacation;
use Carbon\Carbon;
use Livewire\Component;

class ControlDeAsistencias extends Component
{
    public $fecha, $company;

    public function __construct(){
        $this->fecha = Carbon::now()->formatLocalized('%Y-%m-%d');
        $this->company = 1;
    }

    public function userAssistances($company){

        return Assistance::where('asistencia', 'Asistió')->whereHas('user', function($query) use ($company) {
            $query->where('company_id', $company);
        })->whereDate('created_at', $this->fecha)->count();
    }

    public function userNoAssistances($company){

        return Assistance::where('asistencia', 'No asistió')->whereHas('user', function($query) use ($company) {
            $query->where('company_id', $company);
        })->whereDate('created_at', $this->fecha)->count();
    }

    public function userJustifyAttendances($company){

        return Assistance::where('asistencia', 'No asistió')->whereHas('justify_attendance', function($query) {
            $query->where('estatus', 'Aprobado');
        })->whereHas('user', function($query) use ($company) {
            $query->where('company_id', $company);
        })->whereDate('created_at', $this->fecha)->count();
    }

    public function userVacations($company){

        return Vacation::where('estatus', 'Aprobado')->whereHas('user', function($query) use ($company) {
            $query->where('company_id', $company);
        })->whereDate('fecha_inicial', '<=', $this->fecha)->whereDate('fecha_final', '>=', $this->fecha)->count();
    }

    public function render()
    {
        $companies = Company::orderBy('nombre_de_la_compañia')->get();

        $compañia = Company::where('id', $this->company)->first()->nombre_de_la_compañia;

        $empleados = User::where('tipo', 'Empleado')->count();

        $asistencias = Assistance::where('asistencia', 'Asistió')->whereDate('created_at', $this->fecha)->count();

        $faltaron = Assistance::where('asistencia', 'No asistió')->whereDate('created_at', $this->fecha)->count();

        $justificaciones = Assistance::where('asistencia', 'No asistió')->whereHas('justify_attendance', function($query) {
            $query->where('estatus', 'Aprobado');
        })->whereDate('created_at', $this->fecha)->count();

        $vacaciones = Vacation::where('estatus', 'Aprobado')->whereDate('fecha_inicial', '<=', $this->fecha)->whereDate('fecha_final', '>=', $this->fecha)->count();

        return view('livewire.admin.home.control-de-asistencias', [
            'companies' => $companies,
            'compañia' => $compañia,
            'empleados' => $empleados,
            'asistencias' => $asistencias,
            'faltaron' => $faltaron,
            'justificaciones' => $justificaciones,
            'vacaciones' => $vacaciones
        ]);
    }
}
