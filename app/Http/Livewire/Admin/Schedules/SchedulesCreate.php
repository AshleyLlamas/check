<?php

namespace App\Http\Livewire\Admin\Schedules;

use Livewire\Component;

class SchedulesCreate extends Component
{
    public $día, $hora_de_entrada, $hora_de_salida;

    public function rules(){
        
        $array = [];

        $array['día'] = 'required';
        $array['hora_de_entrada'] = 'required';
        $array['hora_de_salida'] = 'required';
    
        return $array;
    }

    public function save(){
        $this->validate();
    }

    public function render()
    {
        return view('livewire.admin.schedules.schedules-create');
    }
}
