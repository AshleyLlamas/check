<?php

namespace App\Http\Livewire\Admin\Devices;

use App\Models\Device;
use Livewire\Component;
use Livewire\WithPagination;

class DevicesIndex extends Component
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
                $this->sort = 'name';
                $this->direction = 'asc';
            break;
            case 4:
                $this->sort = 'name';
                $this->direction = 'desc';
            break;
        }
    }

    public function render()
    {
        $devices = Device::where('name', 'LIKE', '%' . $this->search . '%')
                        ->orderBy($this->sort, $this->direction)
                        ->latest('id')
                        ->paginate();

        $all_devices = Device::where('name', 'LIKE', '%' . $this->search . '%')->count();

        return view('livewire.admin.devices.devices-index', [
            'devices' => $devices,
            'all_devices' => $all_devices
        ]);
    }
}
