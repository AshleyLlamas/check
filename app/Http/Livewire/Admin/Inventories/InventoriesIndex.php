<?php

namespace App\Http\Livewire\Admin\Inventories;

use App\Models\Electronic;
use App\Models\Inventory;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class InventoriesIndex extends Component
{
    use WithPagination;

    public $search, $order, $filtrar = false;
    public $searchQr, $searchCategoria, $searchArticulo, $searchPropietario;
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
                $this->sort = 'qr';
                $this->direction = 'asc';
            break;
            case 4:
                $this->sort = 'qr';
                $this->direction = 'desc';
            break;
        }
    }

    public function filtrar(){
        if($this->filtrar){
            $this->filtrar = false;
        }else{
            $this->filtrar = true;
        }
    }

    public function render()
    {
        $all_electronics = Electronic::all()->count();

        $inventories = Inventory::
        when($this->searchQr, function($query){
            $query->where('qr', 'LIKE', '%' . $this->searchQr . '%');
        })
        ->when($this->searchCategoria, function($query){
            $query->where('inventariable_type', $this->searchCategoria);
        })
        ->when($this->searchArticulo, function($query){
            $query->whereHas('inventariable', function($query){
                $query->where('electronicable_type', $this->searchArticulo);
            });
        })
                        ->orderBy($this->sort, $this->direction)
                        ->latest('id')
                        ->paginate();

        $users = User::orderBy('name')->get();

        $all_inventories = Inventory::where('qr', 'LIKE', '%' . $this->search . '%')->count();

        return view('livewire.admin.inventories.inventories-index', [
            'all_electronics' => $all_electronics,
            'inventories' => $inventories,
            'all_inventories' => $all_inventories,
            'users' => $users
        ]);
    }
}
