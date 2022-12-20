<?php

namespace App\Http\Livewire\Admin\Checks;

use App\Models\Check;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class ChecksIndex extends Component
{
    use WithPagination;

    public $search, $order, $date;
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
                $this->sort = 'name';
                $this->direction = 'asc';
            break;
            case 4:
                $this->sort = 'name';
                $this->direction = 'desc';
            break;
        }
    }

    public function __construct()
    {
        $hoy = Carbon::now();
        $this->date = $hoy->format('Y-m-d');
    }

    public function render()
    {
        $checks = Check::where('fecha', 'LIKE', '%' . $this->date . '%')
                        ->orderBy($this->sort, $this->direction)
                        ->latest('id')
                        ->paginate();
        
        $all_checks = Check::count();

        return view('livewire.admin.checks.checks-index', [
            'checks' => $checks,
            'all_checks' => $all_checks
        ]);
    }
}
