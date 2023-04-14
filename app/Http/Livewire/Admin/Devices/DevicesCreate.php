<?php

namespace App\Http\Livewire\Admin\Devices;

use App\Models\Area;
use App\Models\Device;
use App\Models\User;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class DevicesCreate extends Component
{

    public $name, $email, $password, $password_confirmation, $encargado, $descripción, $área;

    public $usersInDevice = [];

    public function rules(){

        $array = [];

        $array['name'] = 'required|string|max:255';
        $array['email'] = ['required', 'string', 'email', 'max:255', Rule::unique(Device::class)];
        $array['password'] = 'required|confirmed';
        $array['encargado'] = ['nullable'];
        $array['descripción'] = ['required', 'string', 'max:429496729'];

        return $array;
    }

    public function updatedÁrea(){
        $this->usersInDevice = User::whereHas('areas', function($query){
            $query->where('area_id', $this->área);
        })->pluck('id')->toArray();
    }

    public function save(){

        $this->validate();

        if($this->encargado == ''){
            $this->encargado = null;
        }

        $device = Device::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'user_id' => $this->encargado,
            'descripción' => $this->descripción
        ]);

        $device->inUsers()->attach($this->usersInDevice);

        session()->flash('message', 'Dispositivo creado satisfactoriamente.');

        return redirect(route('admin.devices.index'));
    }

    public function render()
    {
        $users = User::orderBy('name')->get();
        $areas = Area::orderBy('área')->get();

        return view('livewire.admin.devices.devices-create', [
            'users' => $users,
            'areas' => $areas
        ]);
    }
}
