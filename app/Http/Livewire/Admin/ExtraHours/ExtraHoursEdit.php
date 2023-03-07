<?php

namespace App\Http\Livewire\Admin\ExtraHours;

use App\Models\Assistance;
use App\Models\ExtraHour;
use App\Models\User;
use Livewire\Component;

class ExtraHoursEdit extends Component
{
    public $extraHour;

    public $fecha, $horas, $user, $observación;

    public function mount(ExtraHour $extraHour){
        $this->fecha = $extraHour->fecha->format('Y-m-d');
        $this->horas = $extraHour->horas;
        $this->user = $extraHour->user_id;
        $this->observación = $extraHour->observación;
    }

    public function rules(){

        $array = [];

        $array['fecha'] = 'required|date';
        $array['horas'] = 'required|integer|between:1,8';
        $array['user'] = ['required'];

        $array['observación'] = 'required|string|max:3294967295';

        return $array;
    }

    public function save(){

        if(
            $extraHour = User::whereHas('extraHours', function($query) {
                $query->whereDate('fecha', $this->fecha);
            })->first()
        ){
            //SI TIENE
            $this->addError('fecha', 'El usuario ya tiene registrado '.$extraHour->horas.' ese mismo día');
        }

        $this->validate();

        if(isset($this->fecha) && isset($this->user)){

            $assistance = Assistance::where('user_id', $this->user)->whereHas('check', function($query){
                $query->whereDate('fecha', '=' , $this->fecha);
            })->first();

            if(isset($assistance)){
                $this->extraHour->assistance_id = $assistance->id;
            }else{
                $this->extraHour->assistance_id = null;
            }
        }else{
            $this->extraHour->assistance_id = null;
        }


        $this->extraHour->fecha = $this->fecha;
        $this->extraHour->horas = $this->horas;
        $this->extraHour->user_id = $this->user;
        $this->extraHour->observación = $this->observación;

        $this->extraHour->save();

        session()->flash('message', 'Hora extra editada satisfactoriamente.');

        return redirect(route('admin.extra_hours.index'));
    }


    public function render()
    {
        $users = User::where('estatus', 'Activo')->whereHas('userSetting', function($query) {
            $query->where('derecho_a_hora_extra', '=', 'Si');
        })->orderBy('name')->get();

        return view('livewire.admin.extra-hours.extra-hours-edit', [
            'users' => $users
        ]);
    }
}
