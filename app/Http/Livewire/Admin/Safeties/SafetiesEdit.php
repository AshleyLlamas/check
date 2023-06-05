<?php

namespace App\Http\Livewire\Admin\Safeties;

use App\Models\Area;
use App\Models\Safety;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SafetiesEdit extends Component
{
    public $safety, $tipo, $afectados, $area, $fecha, $descripción;

    public function mount(Safety $safety){
        $this->safety = $safety;

        $this->tipo = $safety->tipo;
        $this->area = $safety->area_id;
        $this->fecha = $safety->fecha->format('Y-m-d');
        $this->afectados = $this->safety->users->pluck('id')->toArray();//->toarray();
        $this->descripción = $this->safety->descripción;
    }

    public function rules(){

        $array = [];

        $array['area'] = "nullable";
        $array['tipo'] = "required|in:Fatalidad,Primeros auxilios,Accidentes de trabajo,Incidentes a la propiedad,Incidentes ambientables,No hubo incidencias";
        $array['fecha'] = 'required|date|before:tomorrow';

        $array['descripción'] = ['nullable', 'string', 'max:429496729'];

        return $array;
    }

    public function save(){

        $this->validate();

        if($this->area == '') {
            $this->area = null;
        }

        $this->safety->update([
            'tipo' => $this->tipo,
            'user_id' => Auth::id(),
            'area_id' => $this->area,
            'fecha' => $this->fecha,
            'descripción' => $this->descripción
        ]);

        $this->safety->save();

        $this->safety->users()->sync($this->afectados);

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
