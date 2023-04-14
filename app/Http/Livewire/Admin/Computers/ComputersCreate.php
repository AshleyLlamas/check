<?php

namespace App\Http\Livewire\Admin\Computers;

use App\Models\Area;
use App\Models\Company;
use App\Models\Computer;
use App\Models\Electronic;
use App\Models\Inventory;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;

class ComputersCreate extends Component
{
    use WithFileUploads;

    //Inventory
    public $propietario, $garantía, $factura, $fecha_de_adquisición, $descripción, $qr, $abreviación, $arrendado = 'No';

    //Electic
    public $marca, $modelo, $serie, $company;

    //Computer
    public $ram, $procesador, $targeta_gráfica, $tipo, $sistema_operativo;

    //Auxiliar
    public $ordenante = null;

    public function rules(){

        $array = [];

        $array['ram'] = 'required|integer|between:1,84';
        $array['procesador'] = 'required|string|max:255';
        $array['targeta_gráfica'] = 'required|string|max:255';
        $array['tipo'] = 'required|in:Desktop,Laptop';
        $array['sistema_operativo'] = 'required|string|max:255';

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

        $array['qr'] = ['required', 'string', 'max:9', Rule::unique(Inventory::class)];

        return $array;
    }

    public function updatedcompany($company){
        switch($company){
            case 1:
                $this->abreviación = 'C';
            break;
            case 2:
                $this->abreviación = 'T';
            break;
            case 5:
                $this->abreviación = 'M';
            break;
            case 6:
                $this->abreviación = 'S';
            break;
            case 7:
                $this->abreviación = 'L';
            break;
            case 8:
                $this->abreviación = 'MK';
            break;
            default:
                $this->abreviación = '??';
            break;
        }

        if(Electronic::latest('id')->count()){
            $number = Electronic::latest('id')->first()->id+1;
        }else{
            $number = 1;
        }
        $this->qr = $this->abreviación.'-E-'.str_pad($number,4,"0",STR_PAD_LEFT);
    }

    public function save(){

        $this->validate();

        //IMAGENES
        if($this->garantía){
            $garantía = $this->garantía->store('garantías');
        }else{
            $garantía = null;
        }

        if($this->factura){
            $factura = $this->factura->store('facturas');
        }else{
            $factura = null;
        }

        //CREAR COMPUTADORA
        $print = Computer::create([
            'ram' => $this->ram,
            'procesador' => $this->procesador,
            'targeta_gráfica' => $this->targeta_gráfica,
            'tipo' => $this->tipo,
            'sistema_operativo' => $this->sistema_operativo
        ]);

        //CREAR ELECTRONIC
        $electronic = Electronic::create([
            'marca' => $this->marca,
            'modelo' => $this->modelo,
            'serie' => $this->serie,
            'electronicable_id' => $print->id,
            'electronicable_type' => 'App\Models\Computer'
        ]);


        if(isset($propietario)){
            $propientariableId = null;
            $propientariableType = null;
        }else{
            $propientariableId = substr($this->propietario, 1);

            switch($this->propietario[0]){
                case 'A':
                    $propientariableType = User::class ;
                break;
                case 'B':
                    $propientariableType = Area::class ;
                break;
                default:
                break;
            }
        }


        // switch($this->ordenante){
        //     case 'Usuario':
        //         $propientariableId = $this->propietario;
        //         $propientariableType = User::class ;
        //     break;
        //     case 'Área':
        //         $propientariableId = $this->propietario;
        //         $propientariableType = Area::class ;
        //     break;
        //     default:
        //         $propientariableId = null;
        //         $propientariableType = null;
        //     break;
        // }

        //CREAR INVENTORY
        $inventory = Inventory::create([
            'propietariable_id' => $propientariableId,
            'propietariable_type' => $propientariableType,
            'descripción' => $this->descripción,
            'fecha_de_adquisición' => $this->fecha_de_adquisición,
            'qr' => $this->qr,
            'inventariable_id' => $electronic->id,
            'inventariable_type' => 'App\Models\Electronic',
            'garantia' => $garantía,
            'factura' => $factura,
            'company_id' => $this->company,
            'arrendado' => $this->arrendado
        ]);

        session()->flash('message', 'Computadora creada satisfactoriamente.');
        return redirect(route('admin.inventories.index'));

    }

    public function render()
    {
        $users = User::orderBy('name')->get();
        $areas = Area::orderBy('área')->get();
        $companies = Company::orderBy('nombre_de_la_compañia')->get();

        return view('livewire.admin.computers.computers-create', [
            'users' => $users,
            'areas' => $areas,
            'companies' => $companies
        ]);
    }
}
