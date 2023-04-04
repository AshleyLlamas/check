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
        }
    }

    public function __construct()
    {
        $hoy = Carbon::now();
        $this->date = Carbon::now()->formatLocalized('%Y-%m-%d');
    }

    public function render()
    {
        $checks = Check::whereDate('fecha',  $this->date)->orderBy($this->sort, $this->direction)
                        ->latest('id')
                        ->paginate();

        $all_checks = Check::whereDate('fecha',  $this->date)->count();

        return view('livewire.admin.checks.checks-index', [
            'checks' => $checks,
            'all_checks' => $all_checks
        ]);
    }
}
