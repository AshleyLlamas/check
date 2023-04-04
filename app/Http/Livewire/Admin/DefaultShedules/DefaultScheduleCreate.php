<?php

namespace App\Http\Livewire\Admin\DefaultShedules;

use App\Models\DefaultSchedule;
use App\Models\Schedule;
use Livewire\Component;

class DefaultScheduleCreate extends Component
{
    public $nombre_del_horario;

    public $days = [];
    public $días_de_trabajo_a_la_semana, $hora_de_entrada, $hora_de_salida;

    public function rules(){

        $array = [];
        $array['nombre_del_horario'] = 'required|string|max:255';

        //Horario
        $array['days'] = "required";

        //Schedule
        if(count($this->days)){
            foreach($this->days as $n => $day){
                $array['hora_de_entrada.'.$n] = 'required';
                $array['hora_de_salida.'.$n] = 'required|after:hora_de_entrada.'.$n;
            }
        }

        return $array;
    }

    public function save(){

        $this->validate();

        $default_schedule = DefaultSchedule::create([
            'nombre_del_horario' => $this->nombre_del_horario
        ]);

        //SCHEDULE
        if(count($this->days)){
            foreach($this->days as $n => $day){
                Schedule::create([
                    'día' => $day,
                    'hora_de_entrada' => $this->hora_de_entrada[$n],
                    'hora_de_salida' => $this->hora_de_salida[$n],
                    'turno' => null,
                    //'user_id' => $user->id,
                    'scheduleble_id' => $default_schedule->id,
                    'scheduleble_type' => DefaultSchedule::class,
                    'posición' => $n+1,
                    'actual' => true
                ]);
            }
        }

        session()->flash('message', 'Horario predeterminado creado satisfactoriamente.');
        return redirect(route('admin.default_schedules.index'));
    }

    public function render()
    {
        return view('livewire.admin.default-shedules.default-schedule-create');
    }
}
