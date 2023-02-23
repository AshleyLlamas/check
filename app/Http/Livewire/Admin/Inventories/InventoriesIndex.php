<?php

namespace App\Http\Livewire\Admin\Inventories;

use App\Models\Electronic;
use App\Models\Inventory;
use Livewire\Component;
use Livewire\WithPagination;

class InventoriesIndex extends Component
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
        }
    }

    public function render()
    {

        $all_electronics = Electronic::all()->count();

        $inventories = Inventory::where('qr', 'LIKE', '%' . $this->search . '%')
                        ->orderBy($this->sort, $this->direction)
                        ->latest('id')
                        ->paginate();

        $all_inventories = Inventory::where('qr', 'LIKE', '%' . $this->search . '%')->count();

        return view('livewire.admin.inventories.inventories-index', [
            'all_electronics' => $all_electronics,
            'inventories' => $inventories,
            'all_inventories' => $all_inventories
        ]);
    }
}
