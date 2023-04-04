<?php

namespace App\Http\Livewire\Admin\Computers;

use App\Models\Area;
use App\Models\Company;
use App\Models\Computer;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;

use Livewire\Component;

class ComputersEdit extends Component
{
    use WithFileUploads;

    public $computer;

    public $tipo = 'Impresora';

    //Inventory
    public $inventory, $propietario, $garantía, $factura, $fecha_de_adquisición, $descripción, $qr, $abreviación, $arrendado;

    //Electic
    public $electronic, $marca, $modelo, $serie, $company;

    //Auxiliar
    public $ordenante;
    //public $ordenante = null;

    public function mount(Computer $computer){
        $this->computer = $computer;
        $this->electronic = $computer->electronic;
        $this->inventory = $computer->electronic->inventory;

        $this->propietario = $computer->propietario;
        $this->garantía = $computer->garantía;
        $this->factura = $computer->factura;
        $this->fecha_de_adquisición = $computer->fecha_de_adquisición;
        $this->descripción = $computer->descripción;

        $this->marca = $computer->electronic->marca;
        $this->modelo = $computer->electronic->modelo;
        $this->serie = $computer->electronic->serie;

        switch($computer->electronic->inventory->propietariable_type){
            case 'App\Models\User':
                $this->ordenante = 'Usuario';
            break;
            case 'App\Models\Area':
                $this->ordenante = 'Área';
            break;
            case null:
                $this->ordenante = null;
            break;
            default:
                dd('ERROR - CONSULTE CON EL ADMINISTRADOR');
            break;
        }

        $this->propietario = $computer->electronic->inventory->propietariable_id;
        $this->descripción = $computer->electronic->inventory->descripción;

        if(isset($computer->electronic->inventory->fecha_de_adquisición)){
            $this->fecha_de_adquisición =  $computer->electronic->inventory->fecha_de_adquisición->format('Y-m-d');
        }

        $this->qr = $computer->electronic->inventory->qr;
        $this->company = $computer->electronic->inventory->company_id;
        $this->arrendado = $computer->electronic->inventory->arrendado;
    }

    public function rules(){

        $array = [];

        $array['computer.ram'] = 'required|integer|between:1,84';
        $array['computer.procesador'] = 'required|string|max:255';
        $array['computer.targeta_gráfica'] = 'required|string|max:255';
        $array['computer.tipo'] = 'required|in:Desktop,Laptop';
        $array['computer.sistema_operativo'] = 'required|string|max:255';

        $array['propietario'] = 'nullable';
        $array['garantía'] = 'nullable|mimes:jpeg,jpg,png,pdf|max:5048';
        $array['factura'] = 'nullable|mimes:jpeg,jpg,png,pdf|max:5048';
        $array['fecha_de_adquisición'] = ['nullable', 'date'];
        $array['descripción'] = ['nullable', 'string', 'max:429496729'];

        $array['marca'] = ['required', 'string', 'max:255'];
        $array['modelo'] = ['required', 'string', 'max:255'];
        $array['serie'] = ['required', 'string', 'max:255'];
        $array['company'] = ['required'];
        $array['arrendado'] = 'required|in:Si,No';

        $array['qr'] = ['required', 'string', 'max:9', 'unique:inventories,qr,'.$this->computer->electronic->inventory->id];

        return $array;
    }

    public function save(){
        $this->validate();

        if($this->garantía){
            //Si el inventario tiene imagen elimina y actualiza
            Storage::delete($this->inventory->garantia); //Elimino

            $this->inventory->update([ //Actualizo
                'garantia' => $this->garantía->store('garantías'), //Guardo
            ]);
        }

        if($this->factura){
            //Si el inventario tiene imagen elimina y actualiza
            Storage::delete($this->inventory->factura); //Elimino

            $this->inventory->update([ //Actualizo
                'factura' => $this->factura->store('facturas'), //Guardo
            ]);
        }

        switch($this->ordenante){
            case 'Usuario':
                $propietariable_type = 'App\Models\User';
            break;
            case 'Área':
                $propietariable_type = 'App\Models\User';
            break;
            case null:
                $this->propietario = null;
                $propietariable_type = null;
            break;
            default:
                dd('ERROR - CONSULTE CON EL ADMINISTRADOR');
            break;
        }

        //Guardar cambios de inventario
        $this->inventory->update([ //Actualizo
            'propietariable_id' => $this->propietario,
            'propietariable_type' => $propietariable_type,
            'descripción' => $this->descripción,
            'fecha_de_adquisición' => $this->fecha_de_adquisición,
            'qr' => $this->qr,
            'company_id' => $this->company,
            'arrendado' => $this->arrendado
        ]);

        //Guardar cambios de electronico
        $this->electronic->update([ //Actualizo
            'marca' => $this->marca,
            'modelo' => $this->modelo,
            'serie' => $this->serie,
        ]);

        $this->computer->save();

        session()->flash('message', 'Computadora editada satisfactoriamente.');
        return redirect(route('admin.inventories.index'));
    }

    public function render()
    {
        $users = User::orderBy('name')->get();
        $areas = Area::orderBy('área')->get();
        $companies = Company::orderBy('nombre_de_la_compañia')->get();

        return view('livewire.admin.computers.computers-edit',  [
            'users' => $users,
            'areas' => $areas,
            'companies' => $companies
        ]);
    }
}
