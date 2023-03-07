<?php

namespace App\Http\Livewire\Admin\ExtraHours;

use App\Models\Assistance;
use App\Models\ExtraHour;
use App\Models\User;
use Livewire\Component;

class ExtraHoursCreate extends Component
{
    public $fecha, $horas, $user, $observación;

    public function rules(){

        $array = [];

        $array['fecha'] = 'required|date';
        $array['horas'] = 'required|integer|between:1,8';
        $array['user'] = ['required'];

        $array['observación'] = 'required|string|max:3294967295';

        return $array;
    }

    public function save(){

        $this->validate();

        if(isset($this->fecha) && isset($this->user)){

            $assistance = Assistance::where('user_id', $this->user)->whereHas('check', function($query){
                $query->whereDate('fecha', '=' , $this->fecha);
            })->first();

            if(isset($assistance)){
                $assistanceId = $assistance->id;
            }else{
                $assistanceId = null;
            }
        }else{
            $assistanceId = null;
        }

        ExtraHour::create([
            'fecha' => $this->fecha,
            'horas' => $this->horas,
            'user_id' => $this->user,
            'observación' => $this->observación,
            'assistance_id' => $assistanceId,
            'creador_id' => auth()->user()->id,
            'estatus' => 'No aprobado'
        ]);

        session()->flash('message', 'Hora extra creada satisfactoriamente.');

        return redirect(route('admin.extra_hours.index'));

    }

    public function render()
    {
        //$users = User::orderBy('name')->get();

        $users = User::where('estatus', 'Activo')->whereHas('userSetting', function($query) {
            $query->where('derecho_a_hora_extra', '=', 'Si');
        })->orderBy('name')->get();

        return view('livewire.admin.extra-hours.extra-hours-create', [
            'users' => $users
        ]);
    }
}
