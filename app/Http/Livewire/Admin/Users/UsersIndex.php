<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\Area;
use App\Models\Company;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersIndex extends Component
{
    use WithPagination;
    public $order;
    public $searchId, $searchNumero, $searchName, $searchPuesto, $área, $compañia;
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
                $this->sort = 'número_de_empleado';
                $this->direction = 'asc';
            break;
            case 4:
                $this->sort = 'número_de_empleado';
                $this->direction = 'desc';
            break;
            case 5:
                $this->sort = 'name';
                $this->direction = 'asc';
            break;
            case 6:
                $this->sort = 'name';
                $this->direction = 'desc';
            break;
        }
    }

    public function render()
    {
        $users = User::where('tipo', 'Empleado')
        ->when($this->searchId, function($query){
            $query->where('id', $this->searchId);
        })
        ->when($this->searchNumero, function($query){
            $query->where('número_de_empleado', 'LIKE', '%' . $this->searchNumero . '%');
        })
        ->when($this->searchName, function($query){
            $query->where('name', 'LIKE', '%' . $this->searchName . '%');
        })
        ->when($this->searchPuesto, function($query){
            $query->where('puesto', 'LIKE', '%' . $this->searchPuesto . '%');
        })
        ->when($this->área, function($query){
            $query->whereHas('areas', function($query){
                $query->where('area_id', $this->área);
            });
        })
        ->when($this->compañia, function($query){
            $query->where('company_id', $this->compañia);
        })

        ->orderBy($this->sort, $this->direction)
        ->latest('id')
        ->paginate();//->toSql();

        $all_users = User::where('tipo', 'Empleado')->count();

        $areas = Area::orderBy('área')->get();

        $companies = Company::orderBy('nombre_de_la_compañia')->get();

        $usuariosSinFoto = User::where('tipo', 'Empleado')->doesntHave('image')->count();
        $usuariosConFoto = User::where('tipo', 'Empleado')->wherehas('image')->count();

        return view('livewire.admin.users.users-index', [
            'users' => $users,
            'all_users' => $all_users,
            'areas' => $areas,
            'companies' => $companies,
            'usuariosSinFoto' => $usuariosSinFoto,
            'usuariosConFoto' => $usuariosConFoto
        ]);
    }
}
