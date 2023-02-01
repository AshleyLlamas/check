<?php

namespace App\Http\Livewire\Admin\AdmonitionTypes;

use App\Models\admonition_typeType;
use App\Models\AdmonitionType;
use Livewire\Component;
use Livewire\WithPagination;

class AdmonitionTypesIndex extends Component
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
        $admonition_types = AdmonitionType::
                        orderBy($this->sort, $this->direction)
                        ->latest('id')
                        ->paginate();
        
        $all_admonition_types = AdmonitionType::count();

        return view('livewire.admin.admonition-types.admonition-types-index', [
            'admonition_types' => $admonition_types,
            'all_admonition_types' => $all_admonition_types
        ]);
    }
}