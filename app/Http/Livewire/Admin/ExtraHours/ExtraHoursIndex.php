<?php

namespace App\Http\Livewire\Admin\ExtraHours;

use App\Models\ExtraHour;
use Livewire\Component;
use Livewire\WithPagination;

class ExtraHoursIndex extends Component
{
    use WithPagination;

    public $date;

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
        $extraHours = ExtraHour::where('fecha', 'LIKE', '%' . $this->date . '%')
                        ->orderBy($this->sort, $this->direction)
                        ->latest('id')
                        ->paginate();

        $all_extraHours = ExtraHour::where('fecha', 'LIKE', '%' . $this->date . '%')->count();

        return view('livewire.admin.extra-hours.extra-hours-index', [
            'extraHours' => $extraHours,
            'all_extraHours' => $all_extraHours
        ]);
    }
}
