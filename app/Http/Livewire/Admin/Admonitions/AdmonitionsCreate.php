<?php

namespace App\Http\Livewire\Admin\Admonitions;

use App\Models\Admonition;
use App\Models\AdmonitionType;
use App\Models\User;
use Livewire\Component;

class AdmonitionsCreate extends Component
{
    public $fecha_de_la_incidencia, $gravedad, $observaciones, $amonestado, $solicitante, $admonition_type;

    public function rules(){
        
        $array = [];
        
        $array['fecha_de_la_incidencia'] = ['required', 'date'];
        $array['gravedad'] = 'required';
        $array['observaciones'] = ['required', 'string', 'max:429496729'];
        $array['amonestado'] = 'required';
        $array['solicitante'] = 'nullable';
        $array['admonition_type'] = ['required'];

        return $array;
    }

    public function save(){

        $this->validate();

        if($this->admonition_type == ''){
            $this->admonition_type = null;
        }

        if($this->solicitante == ''){
            $this->solicitante = null;
        }

        Admonition::create([
            'amonestado_id' => $this->amonestado,
            'solicitante_id' => $this->solicitante,
            'alta_id' => auth()->user()->id,
            'fecha_de_la_incidencia' => $this->fecha_de_la_incidencia,
            'gravedad' => $this->gravedad,
            'observaciones' => $this->observaciones,
            'admonition_type_id' => $this->admonition_type 
        ]);

        session()->flash('message', 'Amonestación creado satisfactoriamente.');

        return redirect(route('admin.admonitions.index'));
    }
    
    public function render()
    {
        $amonestados = User::orderBy('name')->get();
        $solicitantes = User::orderBy('name')->get();
        $admonition_types = AdmonitionType::orderBy('tipo')->get();

        return view('livewire.admin.admonitions.admonitions-create', [
            'amonestados' => $amonestados,
            'solicitantes' => $solicitantes,
            'admonition_types' => $admonition_types
        ]);
    }
}
