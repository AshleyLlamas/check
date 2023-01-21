<?php

namespace App\Http\Livewire\Admin\Vacations;

use App\Models\Vacation;
use Livewire\Component;
use Livewire\WithPagination;

class VacationsIndex extends Component
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
        $vacations = Vacation::latest('id')
                        ->paginate();

        $all_vacations = Vacation::all()->count();

        return view('livewire.admin.vacations.vacations-index', [
            'vacations' => $vacations,
            'all_vacations' => $all_vacations
        ]);
    }
}
