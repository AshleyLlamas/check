<?php

namespace App\Http\Livewire\Admin\Roles;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class RolesIndex extends Component
{
    use WithPagination;

    public $search;

    protected $paginationTheme = "bootstrap";

    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {

        $roles = Role::where('name', 'LIKE' , '%' . $this->search . '%')
                        ->paginate(10);

        $roles_all = Role::count();

        return view('livewire.admin.roles.roles-index', [
            'roles' => $roles,
            'roles_all' => $roles_all
        ]);
    }
}
