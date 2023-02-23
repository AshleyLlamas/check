<?php

namespace App\Http\Livewire\Admin\Printers;

use App\Models\Area;
use App\Models\Electronic;
use App\Models\Inventory;
use App\Models\Printer;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class PrintersCreate extends Component
{
    use WithFileUploads;

    public $tipo;

    //Inventory
    public $propietario, $garantía, $factura, $fecha_de_adquisición, $descripción;

    //Electic
    public $marca, $modelo, $serie;

    //Auxiliar
    public $ordenante;

    public function rules(){

        $array = [];

        $array['ordenante'] = 'required';
        $array['tipo'] = 'required';
        $array['propietario'] = 'nullable';
        $array['garantía'] = 'nullable|image|mimes:jpeg,jpg,png,pdf|max:5048';
        $array['factura'] = 'nullable|image|mimes:jpeg,jpg,png,pdf|max:5048';
        $array['fecha_de_adquisición'] = ['nullable', 'date'];
        $array['descripción'] = ['nullable', 'string', 'max:429496729'];

        $array['marca'] = ['required', 'string', 'max:255'];
        $array['modelo'] = ['required', 'string', 'max:255'];
        $array['serie'] = ['required', 'string', 'max:255'];

        return $array;
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

        //CREAR IMPRESORA
        $print = Printer::create([
            'tipo' => $this->tipo
        ]);

        //CREAR ELECTRONIC
        $electronic = Electronic::create([
            'marca' => $this->marca,
            'modelo' => $this->modelo,
            'serie' => $this->serie,
            'electronicable_id' => $print->id,
            'electronicable_type' => 'App\Models\Printer'
        ]);

        //CREAR INVENTORY
        $inventory = Inventory::create([
            'user_id' => $this->propietario,
            'descripción' => $this->descripción,
            'fecha_de_adquisición' => $this->fecha_de_adquisición,
            'qr' => 'EIM-'.strtoupper(Str::random(6)),
            'inventariable_id' => $electronic->id,
            'inventariable_type' => 'App\Models\Electronic',
            'garantia' => $garantía,
            'factura' => $factura
        ]);

        session()->flash('message', $this->tipo.' creado satisfactoriamente.');
        return redirect(route('admin.inventories.index'));

    }

    public function render()
    {
        $users = User::orderBy('name')->get();
        $areas = Area::orderBy('área')->get();

        return view('livewire.admin.printers.printers-create', [
            'users' => $users,
            'areas' => $areas
        ]);
    }
}
