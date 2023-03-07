<?php

namespace App\Http\Livewire\Admin\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesCreate extends Component
{
    public $nombre;

    public $permisos = [];

    public function rules(){

        $array = [];

        $array['nombre'] = 'required|string|max:255';
        $array['permisos'] = 'required';

        return $array;
    }

    public function save(){

        $this->validate();

        $role = Role::create([
            'name' => $this->nombre
        ]);

        $role->permissions()->sync($this->permisos);

        return redirect()->route('admin.roles.index')->with('message', 'Rol se creó con éxito.');
    }

    public function render()
    {
        $permissions = Permission::orderBy('name')->get();

        return view('livewire.admin.roles.roles-create', [
            'permissions' => $permissions
        ]);
    }
}
