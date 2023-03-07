<?php

namespace App\Http\Livewire\Admin\AdministrativeRecords;

use App\Models\User;
use Livewire\Component;
use App\Models\AdministrativeRecord;
use App\Models\AdmonitionType;
use Livewire\WithFileUploads;

class AdministrativeRecordsCreate extends Component
{

    use WithFileUploads;

    public $colaborador, $admonition_type, $comentarios_del_colaborador, $observaciones, $categoria_del_permiso, $fecha_del_permiso;

    public function rules(){

        $array = [];

        $array['colaborador'] = 'required';
        $array['comentarios_del_colaborador'] = 'required|image|mimes:jpeg,jpg,png|max:5048';
        $array['observaciones'] = ['required', 'string', 'max:429496729'];
        $array['admonition_type'] = ['required'];
        $array['categoria_del_permiso'] = ['required'];
        $array['fecha_del_permiso'] = ['required', 'date', 'after_or_equal:today'];

        return $array;
    }

    public function save(){

        $this->validate();

        if($this->admonition_type == ''){
            $this->admonition_type = null;
        }

        if($this->comentarios_del_colaborador){
            $comentarios_del_colaborador = $this->comentarios_del_colaborador->store('comentarios_de_los_colaboradores');
        }else{
            $comentarios_del_colaborador = null;
        }

        AdministrativeRecord::create([
            'colaborador_id' => $this->colaborador,
            'admonition_type_id' => $this->admonition_type,
            'comentarios_del_colaborador' => $comentarios_del_colaborador,
            'observaciones' => $this->observaciones,
            'fecha_del_permiso' => $this->fecha_del_permiso,
            'categoria_del_permiso' => $this->categoria_del_permiso,
            'alta_id' => auth()->user()->id
        ]);

        session()->flash('message', 'Acta administrativa creada satisfactoriamente.');

        return redirect(route('admin.administrative_records.index'));

    }

    public function render()
    {
        $users = User::orderBy('name')->get();
        $admonition_types = AdmonitionType::orderBy('tipo')->get();

        return view('livewire.admin.administrative-records.administrative-records-create', [
            'users' => $users,
            'admonition_types' => $admonition_types
        ]);
    }
}
