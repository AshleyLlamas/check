<?php

namespace App\Http\Livewire\Admin\AdmonitionTypes;

use App\Models\AdmonitionType;
use Livewire\Component;

class AdmonitionTypesCreate extends Component
{
    public $tipo;

    public function rules(){
        
        $array = [];
        
        $array['tipo'] = ['required', 'string', 'max:250', 'unique:admonition_types'];

        return $array;
    }

    public function save(){

        $this->validate();

        AdmonitionType::create([
            'tipo' => $this->tipo
        ]);

        session()->flash('message', 'Tipo de monestación creado satisfactoriamente.');

        return redirect(route('admin.admonition_types.index'));
    }


    public function render()
    {
        return view('livewire.admin.admonition-types.admonition-types-create');
    }
}
