<?php

namespace App\Http\Livewire\Admin\AdministrativeRecords;

use Livewire\Component;

class AdministrativeRecordsShow extends Component
{
    public $administrative_record;

    public function render()
    {
        return view('livewire.admin.administrative-records.administrative-records-show');
    }
}
