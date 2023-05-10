<?php

namespace App\Http\Livewire\Admin\Safeties;

use App\Models\Area;
use App\Models\Safety;
use Livewire\Component;
use Livewire\WithPagination;

class SafetiesIndex extends Component
{
    use WithPagination;

    public $search, $order;
    public $sort = 'id';
    public $direction = 'desc';
    protected $paginationTheme = "bootstrap";

    public $searchFecha, $searchTipo, $searchUser, $área;

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
        $safeties = Safety::
        when($this->searchTipo, function($query){
            $query->where('tipo', $this->searchTipo);
        })
        ->when($this->searchUser, function($query){
            $query->whereHas('user', function($query){
                $query->where('name', 'LIKE', '%' . $this->searchUser . '%');
            });
        })
        ->when($this->searchFecha, function($query){
            $query->where('fecha', $this->searchFecha);
        })
        ->when($this->área, function($query){
            $query->whereHas('area', function($query){
                $query->where('area_id', $this->área);
            });
        })

        ->orderBy($this->sort, $this->direction)
        ->latest('id')
        ->paginate();
        
        $all_safeties = Safety::count();

        $areas = Area::orderBy('área')->get();

        return view('livewire.admin.safeties.safeties-index', [
            'safeties' => $safeties,
            'all_safeties' => $all_safeties,
            'areas' => $areas
        ]);
    }
}
