<?php

namespace App\Http\Livewire\Admin\Admonitions;

use App\Models\Admonition;
use App\Models\AdmonitionType;
use App\Models\User;
use Livewire\Component;

class AdmonitionsEdit extends Component
{
    public $admonition;

    public $fecha_de_la_incidencia, $gravedad, $observaciones, $amonestado, $solicitante, $admonition_type;

    public function mount(Admonition $admonition){
        $this->fecha_de_la_incidencia = $admonition->fecha_de_la_incidencia->format('Y-m-d');
        $this->gravedad = $admonition->gravedad;
        $this->observaciones = $admonition->observaciones;
        $this->amonestado = $admonition->amonestado_id;
        $this->solicitante = $admonition->solicitante_id;
        $this->admonition_type = $admonition->admonition_type_id;
    }

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

        if($this->solicitante == ''){
            $this->solicitante = null;
        }

        $this->admonition->fecha_de_la_incidencia = $this->fecha_de_la_incidencia;
        $this->admonition->gravedad = $this->gravedad;
        $this->admonition->observaciones = $this->observaciones;
        $this->admonition->amonestado_id = $this->amonestado;
        $this->admonition->solicitante_id = $this->solicitante;
        $this->admonition->admonition_type_id = $this->admonition_type;

        $this->admonition->save();

        session()->flash('message', 'Amonestación editado satisfactoriamente.');

        return redirect(route('admin.admonitions.index'));
    }

    public function render()
    {
        $amonestados = User::orderBy('name')->get();
        $solicitantes = User::orderBy('name')->get();
        $admonition_types = AdmonitionType::orderBy('tipo')->get();

        return view('livewire.admin.admonitions.admonitions-edit', [
            'amonestados' => $amonestados,
            'solicitantes' => $solicitantes,
            'admonition_types' => $admonition_types
        ]);
    }
}
