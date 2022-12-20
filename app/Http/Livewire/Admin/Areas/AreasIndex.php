<?php

namespace App\Http\Livewire\Admin\Areas;

use App\Models\Area;
use Livewire\Component;
use Livewire\WithPagination;

class AreasIndex extends Component
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
                $this->sort = 'área';
                $this->direction = 'asc';
            break;
            case 4:
                $this->sort = 'área';
                $this->direction = 'desc';
            break;
        }
    }

    public function render()
    {
        $areas = Area::where('área', 'LIKE', '%' . $this->search . '%')
                        ->orderBy($this->sort, $this->direction)
                        ->latest('id')
                        ->paginate();
        
        $all_areas = Area::count();

        return view('livewire.admin.areas.areas-index', [
            'areas' => $areas,
            'all_areas' => $all_areas
        ]);
    }
}
