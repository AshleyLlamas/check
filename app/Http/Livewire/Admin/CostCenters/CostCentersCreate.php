<?php

namespace App\Http\Livewire\Admin\CostCenters;

use App\Models\Company;
use App\Models\CostCenter;
use Livewire\Component;

class CostCentersCreate extends Component
{
    public $folio, $company;

    public function rules(){
        
        $array = [];
        
        $array['folio'] = 'required|string|max:255';
        $array['company'] = ['required'];

        return $array;
    }

    public function save(){
        $this->validate();

        CostCenter::create([
            'folio' => $this->folio,
            'company_id' => $this->company
        ]);

        session()->flash('message', 'Centro de costo creado satisfactoriamente.');

        return redirect(route('admin.cost_centers.index'));
    }

    public function render()
    {
        $companies = Company::orderBy('nombre_de_la_compañia')->get();

        return view('livewire.admin.cost-centers.cost-centers-create', [
            'companies' => $companies
        ]);
    }
}
