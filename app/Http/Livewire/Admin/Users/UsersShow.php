<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\Assistance;
use App\Models\Check;
use App\Models\Schedule;
use Carbon\Carbon;
use Livewire\Component;

class UsersShow extends Component
{
    public $user;

    public $día, $hora_de_entrada, $hora_de_salida;

    // public function addArea(){

    // }

    public function createSchedule()
    {

        //Validation
        $this->validate([
            'día' => 'required',
            'hora_de_entrada' => 'required',
            'hora_de_salida' => 'required|after:hora_de_entrada',
        ]);

        switch($this->día){
            case 'Lunes':
                $posición = 1;
            break;
            case 'Martes':
                $posición = 2;
            break;
            case 'Miércoles':
                $posición = 3;
            break;
            case 'Jueves':
                $posición = 4;
            break;
            case 'Viernes':
                $posición = 5;
            break;
            case 'Sábado':
                $posición = 6;
            break;
            case 'Domingo':
                $posición = 7;
            break;
            default:
                session()->flash('error', 'Día no valido, revise si la seleccion es correcta.');
            break;
        }

        if(Schedule::where('user_id', $this->user->id)->where('día', $this->día)->where('actual', true)->first()){
            session()->flash('error', 'Día no valido, este día ya esta en el horario.');
        }else{
            if(isset($posición)){
                Schedule::create([
                    'posición' => $posición,
                    'día' => $this->día,
                    'hora_de_entrada' => $this->hora_de_entrada,
                    'hora_de_salida' => $this->hora_de_salida,
                    'user_id' => $this->user->id,
                    'actual' => true
                ]);
        
                session()->flash('message', 'Día agregado al horario satisfactoriamente.');
        
                $this->día = '';
                $this->hora_de_entrada = '';
                $this->hora_de_salida = '';
            }
        }

        //Cerrar modal
        $this->dispatchBrowserEvent('close-modal');
    }

    public function editSchedule(Schedule $schedule){

        $this->hora_de_entrada = $schedule->hora_de_entrada->format('h:i');
        $this->hora_de_salida = $schedule->hora_de_salida->format('h:i');

        $this->dispatchBrowserEvent('show-edit-schedule-modal');
    }

    public function editScheduleData(Schedule $schedule)
    {
        //Validation
        $this->validate([
            'hora_de_entrada' => 'required',
            'hora_de_salida' => 'required|after:hora_de_entrada',
        ]);

        $schedule->hora_de_entrada = $this->hora_de_entrada;
        $schedule->hora_de_salida = $this->hora_de_salida;

        $schedule->save();

        session()->flash('message', 'Día editado satisfactoriamente.');

        //For hide modal after add student success
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        //ASISTENCIAS
        $faltas = Assistance::where('user_id', $this->user->id)->where('asistencia', 'No asistió')->count();

        $retardos = Check::where('user_id', $this->user->id)->whereHas('in', function($query) {
            $query->where('estatus', '=', 'Llego tarde');
        })->count();

        //substr( $assistance->check->in->estatus, 0, 11 )

        //CALENDAR
        $hoy = Carbon::now()->format('Y-m-d');

        $json_dias = array();

        foreach(Assistance::where('user_id', $this->user->id)->get() as $assistance){

            $asistencia = $assistance->asistencia;

            if($assistance->asistencia == 'No asistió'){
                if($assistance->justify_attendance){
                    $asistencia = 'Justificado';
                    $color = 'orange';
                }else{
                    $color = 'red'; $assistance->asistencia;
                }
            }else{
                $color = 'gray';
            }

            $json_dias[] = array(
              'title' => $asistencia,
              'start' => date('Y-m-d\TH:i:s', strtotime($assistance->created_at->format('Y-m-d'))),
              'end' => date('Y-m-d\TH:i:s', strtotime($assistance->created_at->format('Y-m-d'))),
              'allDay' => true,
              'color' => $color,
              'url' => route('admin.assistances.show', $assistance)
            );
        }

        $schedules = Schedule::where('user_id', $this->user->id)->where('actual', true)->orderBy('posición', 'asc')->get();

        return view('livewire.admin.users.users-show', [
            'faltas' => $faltas,
            'retardos' => $retardos,
            'hoy' => $hoy,
            'json_dias' => $json_dias,
            'schedules' => $schedules
        ]);
    }
}
