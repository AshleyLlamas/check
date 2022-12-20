<?php

namespace App\Http\Livewire\Admin\Areas;

use App\Models\Area;
use App\Models\User;
use Livewire\Component;

class AreasEdit extends Component
{
    public $encargado;

    public function mount(Area $area){
        $this->area = $area;

        $this->encargado = $area->user_id;
    }

    public function rules(){
        
        $array = [];
        
        $array['area.área'] = 'required|string|max:255';
        $array['encargado'] = 'nullable';

        return $array;
    }

    public function save(){

        $this->validate();

        if($this->encargado == ''){
            $this->encargado = null;
        }

        $this->area->user_id = $this->encargado;
        $this->area->save();

        session()->flash('message', 'Área editada satisfactoriamente.');

        return redirect(route('admin.areas.index'));
    }

    public function render()
    {
        $users = User::orderBy('name')->get();

        return view('livewire.admin.areas.areas-edit', [
            'users' => $users
        ]);
    }
}
