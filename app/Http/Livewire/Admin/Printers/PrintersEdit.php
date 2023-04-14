<?php

namespace App\Http\Livewire\Admin\Printers;

use App\Models\Area;
use App\Models\Company;
use App\Models\Printer;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class PrintersEdit extends Component
{
    use WithFileUploads;

    public $printer;

    public $tipo = 'Impresora';

    //Inventory
    public $inventory, $propietario, $garantía, $factura, $fecha_de_adquisición, $descripción, $qr, $abreviación, $arrendado;

    //Electronic
    public $electronic, $marca, $modelo, $serie, $company;

    //Auxiliar
    public $ordenante;
    //public $ordenante = null;

    public function mount(Printer $printer){
        $this->printer = $printer;
        $this->electronic = $printer->electronic;
        $this->inventory = $printer->electronic->inventory;

        $this->marca = $printer->electronic->marca;
        $this->modelo = $printer->electronic->modelo;
        $this->serie = $printer->electronic->serie;

        $this->tipo = $printer->tipo;

        // switch($printer->electronic->inventory->propietariable_type){
        //     case 'App\Models\User':
        //         $this->ordenante = 'Usuario';
        //     break;
        //     case 'App\Models\Area':
        //         $this->ordenante = 'Área';
        //     break;
        //     case null:
        //         $this->ordenante = null;
        //     break;
        //     default:
        //         dd('ERROR - CONSULTE CON EL ADMINISTRADOR');
        //     break;
        // }

        // $this->propietario = $printer->electronic->inventory->propietariable_id;

        if(isset($printer->electronic->inventory->propietariable_type) && isset($printer->electronic->inventory->propietariable_id)){
            switch($printer->electronic->inventory->propietariable_type){
                case 'App\Models\User':
                    $this->propietario = 'A'.$printer->electronic->inventory->propietariable_id;
                break;
                case 'App\Models\Area':
                    $this->propietario = 'B'.$printer->electronic->inventory->propietariable_id;
                break;
                case null:
                    $this->propietario = null; //esta de más
                break;
                default:
                    dd('ERROR - CONSULTE CON EL ADMINISTRADOR');
                break;
            }
        }

        $this->fecha_de_adquisición =  $printer->electronic->inventory->fecha_de_adquisición->format('Y-m-d');
        $this->descripción = $printer->electronic->inventory->descripción;
        $this->qr =  $printer->electronic->inventory->qr;
        $this->company = $printer->electronic->inventory->company_id;
        $this->arrendado = $printer->electronic->inventory->arrendado;
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

        if(!isset($this->propietario) || $this->propietario ==  ""){
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

        //Guardar cambios de inventario
        $this->inventory->update([ //Actualizo
            'propietariable_id' => $propientariableId,
            'propietariable_type' => $propientariableType,
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

        $this->printer->tipo = $this->tipo;
        $this->printer->save();

        session()->flash('message', 'Impresora editada satisfactoriamente.');
        return redirect(route('admin.inventories.index'));
    }

    public function rules(){

        $array = [];

        $array['printer.tipo'] = 'required|in:Impresora,Plotter';
        $array['propietario'] = 'nullable';
        $array['garantía'] = 'nullable|image|mimes:jpeg,jpg,png,pdf|max:5048';
        $array['factura'] = 'nullable|image|mimes:jpeg,jpg,png,pdf|max:5048';
        $array['fecha_de_adquisición'] = ['nullable', 'date'];
        $array['descripción'] = ['nullable', 'string', 'max:429496729'];

        $array['marca'] = ['required', 'string', 'max:255'];
        $array['modelo'] = ['required', 'string', 'max:255'];
        $array['serie'] = ['required', 'string', 'max:255'];
        $array['company'] = ['required'];
        $array['qr'] = ['required', 'string', 'max:9', 'unique:inventories,qr,'.$this->printer->electronic->inventory->id];
        $array['arrendado'] = 'required|in:Si,No';

        return $array;
    }

    public function render()
    {
        $users = User::orderBy('name')->get();
        $areas = Area::orderBy('área')->get();
        $companies = Company::orderBy('nombre_de_la_compañia')->get();

        return view('livewire.admin.printers.printers-edit', [
            'users' => $users,
            'areas' => $areas,
            'companies' => $companies
        ]);
    }
}
