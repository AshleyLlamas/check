<?php

namespace App\Http\Livewire\Admin\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesEdit extends Component
{
    public $role, $nombre;

    public $permisos = [];

    public function mount(Role $role){
        $this->nombre = $role->name;
        $this->permisos = $role->getAllPermissions()->pluck('id')->toArray();
    }

    public function rules(){

        $array = [];

        $array['nombre'] = 'required|string|max:255';
        $array['permisos'] = 'required';

        return $array;
    }

    public function save(){

        $this->validate();

        $this->role->permissions()->sync($this->permisos);

        $this->role->name = $this->nombre;
        $this->role->save();

        return redirect()->route('admin.roles.index')->with('message', 'Rol se editó con éxito.');
    }

    public function render()
    {
        $permissions = Permission::orderBy('name')->get();

        return view('livewire.admin.roles.roles-edit', [
            'permissions' => $permissions
        ]);
    }
}
