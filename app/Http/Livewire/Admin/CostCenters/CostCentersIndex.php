<?php

namespace App\Http\Livewire\Admin\CostCenters;

use App\Models\CostCenter;
use Livewire\Component;
use Livewire\WithPagination;

class CostCentersIndex extends Component
{
    use WithPagination;

    public $search, $order;
    public $sort = 'id';
    public $direction = 'desc';
    protected $paginationTheme = "bootstrap";

    public function updatingSearch(){
        $this->resetPage();
    }

    public function updatedorder($order){
        if($order == 1){
            $this->direction = 'asc';
        }
        switch($order){
            case 1:
                $this->sort = 'id';
                $this->direction = 'desc';
            break;
            case 2:
                $this->sort = 'id';
                $this->direction = 'asc';
            break;
            case 3:
                $this->sort = 'folio';
                $this->direction = 'asc';
            break;
            case 4:
                $this->sort = 'folio';
                $this->direction = 'desc';
            break;
        }
    }

    public function render()
    {
        $cost_centers = CostCenter::where('folio', 'LIKE', '%' . $this->search . '%')
                        ->orderBy($this->sort, $this->direction)
                        ->latest('id')
                        ->paginate();
        
        $all_cost_centers = CostCenter::all()->count();

        return view('livewire.admin.cost-centers.cost-centers-index', [
            'cost_centers' => $cost_centers,
            'all_cost_centers' => $all_cost_centers
        ]);
    }
}
