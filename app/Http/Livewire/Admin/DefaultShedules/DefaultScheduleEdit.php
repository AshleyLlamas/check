<?php

namespace App\Http\Livewire\Admin\DefaultShedules;

use App\Models\DefaultSchedule;
use App\Models\Schedule;
use Livewire\Component;

class DefaultScheduleEdit extends Component
{
    public $default_schedule;

    public $days = [];
    public $hora_de_entrada, $hora_de_salida;

    public function mount(DefaultSchedule $default_schedule){
        $this->default_schedule = $default_schedule;

        $schedules = Schedule::where('scheduleble_id', $default_schedule->id)->where('scheduleble_type', DefaultSchedule::class)->orderBy('posición', 'asc');

        $this->days = $schedules->pluck('día')->toArray();

        foreach($schedules->get() as $i => $day){
            $this->hora_de_entrada[$i] = $day->hora_de_entrada->format('H:i');
            $this->hora_de_salida[$i] = $day->hora_de_salida->format('H:i');
        }
    }

    public function rules(){

        $array = [];

        //DefaultSchedule
        $array['default_schedule.nombre_del_horario'] = 'required|string|max:255';

        //Schedule
        if(count($this->days)){
            foreach($this->days as $n => $day){
                $array['hora_de_entrada.'.$n] = 'required';
                $array['hora_de_salida.'.$n] = 'required|after:hora_de_entrada.'.$n;
            }
        }

        return $array;
    }

    protected $messages = [
        'hora_de_entrada.*.required' => 'La hora de entrada es obligatorio.',
        'hora_de_salida.*.required' => 'La hora de salida es obligatorio.',
    ];

    public function save(){
        $this->validate();

        $where_not_in_schedule = Schedule::where('scheduleble_id', $this->default_schedule->id)->where('scheduleble_type', DefaultSchedule::class)->whereNotIn('día', $this->days);

        $where_not_in_schedule->delete();

        foreach($this->days as $n => $day){
            $schedule = Schedule::where('scheduleble_id', $this->default_schedule->id)->where('scheduleble_type', DefaultSchedule::class)->where('día', $day)->first();

            //Si no existe crear un nuevo SCHEDULE
            if(is_null($schedule)){
                Schedule::create([
                    'día' => $day,
                    'hora_de_entrada' => $this->hora_de_entrada[$n],
                    'hora_de_salida' => $this->hora_de_salida[$n],
                    'turno' => null,
                    //'user_id' => $user->id,
                    'scheduleble_id' => $this->default_schedule->id,
                    'scheduleble_type' => DefaultSchedule::class,
                    'posición' => $n+1,
                    'actual' => true
                ]);
            }else{
                $schedule->hora_de_entrada = $this->hora_de_entrada[$n];
                $schedule->hora_de_salida = $this->hora_de_salida[$n];
                $schedule->posición = $n+1;
                $schedule->save();
            }
        }

        $this->default_schedule->save();

        session()->flash('message', 'Horario predeterminado editado satisfactoriamente.');
        return redirect(route('admin.default_schedules.index'));
    }

    public function render()
    {
        return view('livewire.admin.default-shedules.default-schedule-edit');
    }
}
