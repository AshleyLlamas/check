<?php

namespace App\Http\Livewire\Admin\Areas;

use App\Models\Area;
use App\Models\User;
use Livewire\Component;

class AreasCreate extends Component
{
    public $área, $encargado;

    public function rules(){
        
        $array = [];
        
        $array['área'] = 'required|string|max:255';
        $array['encargado'] = 'nullable';

        return $array;
    }

    public function save(){

        $this->validate();

        if($this->encargado == ''){
            $this->encargado = null;
        }
        
        Area::create([
            'área' => $this->área,
            'user_id' => $this->encargado,
        ]);

        session()->flash('message', 'Área creada satisfactoriamente.');

        return redirect(route('admin.areas.index'));
    }

    public function render()
    {
        $users = User::orderBy('name')->get();

        return view('livewire.admin.areas.areas-create', [
            'users' => $users,
        ]);
    }
}
