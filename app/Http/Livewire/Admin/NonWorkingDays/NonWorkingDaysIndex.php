<?php

namespace App\Http\Livewire\Admin\NonWorkingDays;

use App\Models\NonWorkingDay;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class NonWorkingDaysIndex extends Component
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

    public function render()
    {
        $hoy = Carbon::now()->format('Y-m-d');

        $json_dias = array();

        foreach(NonWorkingDay::all() as $day){
            $json_dias[] = array(
              'title' => $day->razón,
              'start' => date('Y-m-d\TH:i:s', strtotime($day->fecha->format('Y-m-d'))),
              'end' => date('Y-m-d\TH:i:s', strtotime($day->fecha->format('Y-m-d'))),
              'allDay' => true,
              'color' => 'gray',
            );
        }

        foreach(User::where('fecha_de_nacimiento', '!=', null)->get() as $user){

            $dia = Carbon::now()->format('Y').$user->fecha_de_nacimiento->format('-m-d');

            $json_dias[] = array(
                'title' => 'Cumpleaños de '.$user->name,
                'start' => date('Y-m-d\TH:i:s', strtotime($dia)),
                'end' => date('Y-m-d\TH:i:s', strtotime($dia)),
                'allDay' => true,
                'color' => 'purple',
            );
        }

        $no_working_days = NonWorkingDay::where('fecha', 'LIKE', '%' .  Carbon::now()->formatLocalized($this->date) . '%')
                    ->orderBy($this->sort, $this->direction)
                    ->latest('id')
                    ->paginate();

        $all_no_working_days = NonWorkingDay::whereDate('fecha', '=' , Carbon::now()->formatLocalized($this->date))->count();

        return view('livewire.admin.non-working-days.non-working-days-index', [
            'hoy' => $hoy,
            'json_dias' => $json_dias,
            'no_working_days' => $no_working_days,
            'all_no_working_days' => $all_no_working_days
        ]);
    }
}
