<?php

namespace App\Http\Livewire\Admin\Safeties;

use App\Models\Area;
use App\Models\Safety;
use App\Models\User;
use Livewire\Component;

class SafetiesEdit extends Component
{
    public $safety, $tipo, $user, $area, $fecha;

    public function mount(Safety $safety){
        $this->safety = $safety;

        $this->tipo = $safety->tipo;
        $this->user = $safety->user_id;
        $this->area = $safety->area_id;
        $this->fecha = $safety->fecha->format('Y-m-d');
    }

    public function rules(){

        $array = [];

        $array['area'] = "nullable";
        $array['user'] = "required";
        $array['tipo'] = "required|in:Fatalidad,Primeros auxilios,Accidentes de trabajo,Incidentes a la propiedad,Incidentes ambientables";
        $array['fecha'] = 'required|date|before:tomorrow';

        return $array;
    }

    public function save(){

        $this->validate();

        if($this->area == '') {
            $this->area = null;
        }

        $this->safety->update([
            'tipo' => $this->tipo,
            'user_id' => $this->user,
            'area_id' => $this->area,
            'fecha' => $this->fecha
        ]);

        $this->safety->save();

        session()->flash('message', 'Incidencia editada satisfactoriamente.');
        return redirect(route('admin.safeties.index'));
    }

    public function render()
    {
        $areas = Area::orderBy('área')->get();
        $users = User::orderBy('name')->get();
        
        return view('livewire.admin.safeties.safeties-edit', [
            'areas' => $areas,
            'users' => $users
        ]);
    }
}
