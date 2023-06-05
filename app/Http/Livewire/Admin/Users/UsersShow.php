<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\Assistance;
use App\Models\Attendance;
use App\Models\Check;
use App\Models\Schedule;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class UsersShow extends Component
{
    use WithPagination;
    public $user;

    public $día, $hora_de_entrada, $hora_de_salida;

    public $card = 1;

    protected $paginationTheme = "bootstrap";

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

        if(Schedule::where('scheduleble_id', $this->user->id)->where('scheduleble_type', User::class)->where('día', $this->día)->where('actual', true)->first()){
            session()->flash('error', 'Día no valido, este día ya esta en el horario.');
        }else{
            if(isset($posición)){
                Schedule::create([
                    'posición' => $posición,
                    'día' => $this->día,
                    'hora_de_entrada' => $this->hora_de_entrada,
                    'hora_de_salida' => $this->hora_de_salida,
                    //'user_id' => $this->user->id,
                    'scheduleble_id' => $this->user->id,
                    'scheduleble_type' => 'App\Models\User',
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

    public function card($card){
        switch($card){
            case 1:
                $this->card = 2;
            break;
            case 2:
                $this->card = 1;
            break;
        }
    }

    public function render()
    {

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
                    if($assistance->justify_attendance->estatus == "Aprobado"){
                        $asistencia = 'Justificado';
                        $color = 'green';
                    }else{
                        $asistencia = 'En proceso de justifición';
                        $color = 'orange';
                    }
                    
                }else{
                    $color = 'red'; $assistance->asistencia;
                }
            }else{
                $color = 'gray';
            }

            $json_dias[] = array(
              'title' => $asistencia,
              'start' => date('Y-m-d\TH:i:s', strtotime($assistance->created_at->format('Y-m-d'))),
              'end' => date('Y-m-d\TH:i:s', strtotime($assistance->created_at->modify('+1 day')->format('Y-m-d'))),
              'allDay' => true,
              'color' => $color,
              'url' => route('admin.assistances.show', $assistance)
            );
        }

        $schedules = Schedule::where('scheduleble_id', $this->user->id)->where('scheduleble_type', 'App\Models\User')->where('actual', true)->orderBy('posición', 'asc')->get();

        return view('livewire.admin.users.users-show', [
            'faltas' => $faltas,
            'retardos' => $retardos,
            'hoy' => $hoy,
            'json_dias' => $json_dias,
            'schedules' => $schedules,
            "checks" => Check::Where("user_id", $this->user->id)->orderBy('fecha', 'desc')->paginate(10)
        ]);
    }
}
