<?php

namespace App\Http\Livewire\Admin\DefaultShedules;

use App\Models\DefaultSchedule;
use Livewire\Component;
use Livewire\WithPagination;

class DefaultScheduleIndex extends Component
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
        $default_schedules = DefaultSchedule::where('nombre_del_horario', 'LIKE', '%' . $this->search . '%')
                        ->orderBy($this->sort, $this->direction)
                        ->latest('id')
                        ->paginate();

        $all_default_schedules = DefaultSchedule::count();

        return view('livewire.admin.default-shedules.default-schedule-index', [
            'default_schedules' => $default_schedules,
            'all_default_schedules' => $all_default_schedules
        ]);
    }
}
