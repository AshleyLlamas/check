<?php

namespace App\Http\Livewire\Admin\AdministrativeRecords;

use Livewire\Component;
use App\Models\AdministrativeRecord;
use App\Models\AdmonitionType;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class AdministrativeRecordsEdit extends Component
{
    use WithFileUploads;

    public $administrative_record;

    public $colaborador, $admonition_type, $comentarios_del_colaborador, $categoria_del_permiso, $observaciones, $fecha_del_permiso;

    public function mount(AdministrativeRecord $administrative_record){
        $this->administrative_record = $administrative_record;

        $this->colaborador = $administrative_record->colaborador_id;
        $this->admonition_type = $administrative_record->admonition_type_id;
        $this->categoria_del_permiso = $administrative_record->categoria_del_permiso;
        $this->observaciones = $administrative_record->observaciones;
        $this->fecha_del_permiso = $administrative_record->fecha_del_permiso->format('Y-m-d');
    }

    public function rules(){

        $array = [];

        $array['colaborador'] = 'required';
        $array['admonition_type'] = 'required';
        $array['comentarios_del_colaborador'] = 'required|image|mimes:jpeg,jpg,png|max:5048';
        $array['observaciones'] = ['required', 'string', 'max:429496729'];
        $array['categoria_del_permiso'] = ['required'];
        $array['fecha_del_permiso'] = ['required', 'date', 'after_or_equal:today'];

        return $array;
    }

    public function save(){

        $this->validate();

        if($this->colaborador == ''){
            $this->colaborador = null;
        }

        if($this->admonition_type == ''){
            $this->admonition_type = null;
        }

        if($this->comentarios_del_colaborador == ''){
            $this->comentarios_del_colaborador = null;
        }

        if($this->categoria_del_permiso == ''){
            $this->categoria_del_permiso = null;
        }

        if($this->observaciones == ''){
            $this->observaciones = null;
        }

        if($this->comentarios_del_colaborador){

            Storage::delete([$this->administrative_record->comentarios_del_colaborador]);

            $this->administrative_record->update([ //Actualizo
                'comentarios_del_colaborador' => $this->comentarios_del_colaborador->store('comentarios_de_los_colaboradores'), //Guardo
            ]);
        }

        $this->administrative_record->colaborador_id = $this->colaborador;
        $this->administrative_record->admonition_type_id = $this->admonition_type;
        $this->administrative_record->categoria_del_permiso = $this->categoria_del_permiso;
        $this->administrative_record->observaciones = $this->observaciones;
        $this->administrative_record->fecha_del_permiso = $this->fecha_del_permiso;

        $this->administrative_record->save();

        session()->flash('message', 'Acta administrativa editada satisfactoriamente.');

        return redirect(route('admin.administrative_records.index'));

    }

    public function render()
    {
        $users = user::orderBy('name')->get();
        $admonition_types = AdmonitionType::orderBy('tipo')->get();

        return view('livewire.admin.administrative-records.administrative-records-edit', [
            'users' => $users,
            'admonition_types' => $admonition_types
        ]);
    }
}
