<?php

namespace App\Http\Livewire\Admin\Areas;

use App\Models\Area;
use App\Models\Company;
use App\Models\CostCenter;
use App\Models\User;
use Livewire\Component;

class AreasCreate extends Component
{
    public $área, $encargado, $ubicación, $company, $cost_centers, $cost_center;

    public function rules(){
        
        $array = [];
        
        $array['área'] = 'required|string|max:255';
        $array['encargado'] = 'nullable';
        $array['ubicación'] = 'required|string|max:255';
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

        if($this->ubicación == ''){
            $this->ubicación = null;
        }

        if($this->cost_center == '' || $this->cost_center == null){
            $cost_center = null;
        }else{
            $cost_center = $this->cost_center;
        }
        
        Area::create([
            'área' => $this->área,
            'user_id' => $this->encargado,
            'ubicación' => $this->ubicación,
            'company_id' => $this->company,
            'cost_center_id' => $cost_center
        ]);

        session()->flash('message', 'Área creada satisfactoriamente.');

        return redirect(route('admin.areas.index'));
    }

    public function render()
    {
        $companies = Company::orderBy('nombre_de_la_compañia')->get();
        $users = User::orderBy('name')->get();

        return view('livewire.admin.areas.areas-create', [
            'companies' => $companies,
            'users' => $users,
        ]);
    }
}
