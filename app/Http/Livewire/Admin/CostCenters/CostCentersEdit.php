<?php

namespace App\Http\Livewire\Admin\CostCenters;

use App\Models\Company;
use App\Models\CostCenter;
use Livewire\Component;

class CostCentersEdit extends Component
{
    public $cost_center, $company;

    public function mount(CostCenter $cost_center){
        $this->cost_center = $cost_center;
        $this->company = $this->cost_center->company_id;
    }

    public function rules(){
        
        $array = [];
        
        $array['cost_center.folio'] = 'required|string|max:255';
        $array['company'] = ['required'];

        return $array;
    }

    public function save(){
        $this->validate();

        $this->cost_center->company_id = $this->company;

        $this->cost_center->save();

        session()->flash('message', 'Centro de costo editado satisfactoriamente.');

        return redirect(route('admin.cost_centers.index'));
    }

    public function render()
    {
        $companies = Company::orderBy('nombre_de_la_compañia')->get();

        return view('livewire.admin.cost-centers.cost-centers-edit', [
            'companies' => $companies
        ]);
    }
}
