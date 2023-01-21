<?php

namespace App\Http\Livewire\Admin\Areas;

use App\Models\Area;
use App\Models\Company;
use App\Models\CostCenter;
use App\Models\User;
use Livewire\Component;

class AreasEdit extends Component
{
    public $area, $encargado, $company, $cost_centers, $cost_center;

    public function mount(Area $area){
        $this->area = $area;

        $this->encargado = $area->user_id;
        $this->company = $area->company_id;
        $this->cost_center = $area->cost_center_id;
    }

    public function rules(){
        
        $array = [];
        
        $array['area.área'] = 'required|string|max:255';
        $array['encargado'] = 'nullable';
        $array['area.ubicación'] = 'required|string|max:255';
        $array['company'] = ['nullable'];
        $array['cost_center'] = ['nullable'];

        return $array;
    }

    public function updatedcompany($company){
        $this->cost_centers = CostCenter::where('company_id', $company)->orderBy('folio')->get();
        $this->cost_center = '';
    }

    public function save(){

        $this->validate();

        if($this->encargado == ''){
            $this->encargado = null;
        }

        if($this->cost_center == '' || $this->cost_center == null){
            $cost_center = null;
        }else{
            $cost_center = $this->cost_center;
        }

        $this->area->user_id = $this->encargado;
        $this->area->company_id = $this->company;
        $this->area->cost_center_id = $cost_center;
        $this->area->save();

        session()->flash('message', 'Área editada satisfactoriamente.');

        return redirect(route('admin.areas.index'));
    }

    public function render()
    {
        $companies = Company::orderBy('nombre_de_la_compañia')->get();
        $users = User::orderBy('name')->get();

        return view('livewire.admin.areas.areas-edit', [
            'companies' => $companies,
            'users' => $users
        ]);
    }
}
