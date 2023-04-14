<?php

namespace App\Http\Livewire\Admin\Devices;

use App\Models\Device;
use App\Models\User;
use Livewire\Component;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class DevicesEdit extends Component
{
    public $device, $name, $email, $password, $password_confirmation, $encargado, $descripción;

    public $usersInDevice = [];

    public function mount(Device $device){
        $this->name = $device->name;
        $this->email = $device->email;
        $this->encargado = $device->user_id;
        $this->descripción = $device->descripción;

        $this->usersInDevice = $device->inUsers->pluck('id')->toArray();
    }

    public function rules(){

        $array = [];

        $array['name'] = 'required|string|max:255';
        $array['email'] = ['required', 'string', 'email', 'max:255', 'unique:devices,email,'.$this->device->id];

        if(isset($this->password)){
            $array['password'] = 'required|confirmed';
        }

        $array['encargado'] = ['nullable'];
        $array['descripción'] = ['required', 'string', 'max:429496729'];

        return $array;
    }

    public function save(){

        $this->validate();

        if($this->encargado == ''){
            $this->encargado = null;
        }

        $this->device->update([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'user_id' => $this->encargado,
            'descripción' => $this->descripción
        ]);

        $this->device->inUsers()->sync($this->usersInDevice);

        session()->flash('message', 'Dispositivo editado satisfactoriamente.');

        return redirect(route('admin.devices.index'));
    }

    public function render()
    {
        $users = User::orderBy('name')->get();

        return view('livewire.admin.devices.devices-edit', [
            'users' => $users,
        ]);
    }
}
