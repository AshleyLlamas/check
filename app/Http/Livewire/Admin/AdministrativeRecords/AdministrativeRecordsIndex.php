<?php

namespace App\Http\Livewire\Admin\AdministrativeRecords;

use App\Models\AdministrativeRecord;
use Livewire\Component;
use Livewire\WithPagination;

class AdministrativeRecordsIndex extends Component
{
    public $administrative_record;

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
        $administrative_records = AdministrativeRecord::orderBy($this->sort, $this->direction)
                        ->latest('id')
                        ->paginate();
        
        $all_administrative_records = AdministrativeRecord::count();

        return view('livewire.admin.administrative-records.administrative-records-index', [
            'administrative_records' => $administrative_records,
            'all_administrative_records' => $all_administrative_records
        ]);
    }
}
