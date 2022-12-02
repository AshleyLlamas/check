<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\Assistance;
use App\Models\Check;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class UsersShow extends Component
{
    public $user;

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

            if($assistance->asistencia == 'No asistió'){
                $color = 'red';
            }else{
                $color = 'gray';
            }

            $json_dias[] = array(
              'title' => $assistance->asistencia,
              'start' => date('Y-m-d\TH:i:s', strtotime($assistance->check->fecha)),
              'end' => date('Y-m-d\TH:i:s', strtotime($assistance->check->fecha)),
              'allDay' => true,
              'color' => $color,
              'url' => route('admin.assistances.show', $assistance)
            );
        }

        return view('livewire.admin.users.users-show', [
            'faltas' => $faltas,
            'retardos' => $retardos,
            'hoy' => $hoy,
            'json_dias' => $json_dias
        ]);
    }
}
