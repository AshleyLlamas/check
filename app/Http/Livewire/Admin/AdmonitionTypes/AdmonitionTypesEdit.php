<?php

namespace App\Http\Livewire\Admin\AdmonitionTypes;

use Livewire\Component;

class AdmonitionTypesEdit extends Component
{
    public $admonition_type;

    public function rules(){
        
        $array = [];
        
        $array['admonition_type.tipo'] = ['required', 'string', 'max:250', 'unique:admonition_types,tipo,'.$this->admonition_type->id];

        return $array;
    }

    public function save(){

        $this->validate();

        $this->admonition_type->save();

        session()->flash('message', 'Tipo de monestación editado satisfactoriamente.');

        return redirect(route('admin.admonition_types.index'));
    }

    public function render()
    {
        return view('livewire.admin.admonition-types.admonition-types-edit');
    }
}
