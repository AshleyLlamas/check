<?php

namespace App\Http\Livewire\Admin\Assistances;

use App\Models\Assistance;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class AssistancesIndex extends Component
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
        $this->date = $hoy->format('Y-m-d');
    }

    public function render()
    {
        $assistances = Assistance::whereDate('created_at', '=' , Carbon::now()->formatLocalized($this->date))
                        ->orderBy($this->sort, $this->direction)
                        ->latest('id')
                        ->paginate();

        $all_assistances = Assistance::whereDate('created_at', '=' , Carbon::now()->formatLocalized($this->date))->count();

        $usuariosSinFoto = Assistance::whereDate('created_at', '=', Carbon::now()->formatLocalized($this->date))->whereHas('user', function($query){
            $query->where('tipo', 'Empleado')->doesntHave('image');
        })->count();

        $usuariosConFoto = Assistance::whereDate('created_at', '=', Carbon::now()->formatLocalized($this->date))->whereHas('user', function($query){
            $query->where('tipo', 'Empleado')->wherehas('image');
        })->count();

        return view('livewire.admin.assistances.assistances-index', [
            'assistances' => $assistances,
            'all_assistances' => $all_assistances,
            'usuariosSinFoto' => $usuariosSinFoto,
            'usuariosConFoto' => $usuariosConFoto
        ]);
    }
}
