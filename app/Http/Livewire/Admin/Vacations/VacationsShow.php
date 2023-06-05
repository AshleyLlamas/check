<?php

namespace App\Http\Livewire\Admin\Vacations;

use App\Models\Approval;
use App\Models\AreaUser;
use App\Models\Vacation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class VacationsShow extends Component
{
    public $vacation;

    public $aprobación, $observaciones;

    public function createApprovalJefe()
    {

        if(!isset($this->vacation->approval_jefe_id)){
            //Validation
            $this->validate([
                'aprobación' => 'required',
                'observaciones' => 'required|max:4294967295',
            ]);

            $approval = Approval::create([
                'aprobación' => $this->aprobación,
                'observaciones' => $this->observaciones,
                'user_id' => auth()->user()->id
            ]);

            $this->vacation->approval_jefe_id = $approval->id;
            $this->vacation->save();
    
            $this->aprobación = '';
            $this->observaciones = '';

            $this->cambiarEstatus();

            session()->flash('message', 'Aprobación creado satisfactoriamente.');
        }

        //Cerrar modal
        $this->dispatchBrowserEvent('close-modal');
    }

    public function createApprovalRh()
    {

        if(!isset($this->vacation->approval_rh_id)){
            //Validation
            $this->validate([
                'aprobación' => 'required',
                'observaciones' => 'required|max:4294967295',
            ]);

            $approval = Approval::create([
                'aprobación' => $this->aprobación,
                'observaciones' => $this->observaciones,
                'user_id' => auth()->user()->id
            ]);

            $this->vacation->approval_rh_id = $approval->id;
            $this->vacation->save();
    
            $this->aprobación = '';
            $this->observaciones = '';

            $this->cambiarEstatus();

            session()->flash('message', 'Aprobación creado satisfactoriamente.');
        }

        //Cerrar modal
        $this->dispatchBrowserEvent('close-modal');
    }

    //Se elimino
    // public function createApprovalDg()
    // {

    //     if(!isset($this->vacation->approval_dg_id)){
    //         //Validation
    //         $this->validate([
    //             'aprobación' => 'required',
    //             'observaciones' => 'required|max:4294967295',
    //         ]);

    //         $approval = Approval::create([
    //             'aprobación' => $this->aprobación,
    //             'observaciones' => $this->observaciones,
    //             'user_id' => auth()->user()->id
    //         ]);

    //         $this->vacation->approval_dg_id = $approval->id;
    //         $this->vacation->save();
    
    //         $this->aprobación = '';
    //         $this->observaciones = '';

    //         $this->cambiarEstatus();

    //         session()->flash('message', 'Aprobación creado satisfactoriamente.');
    //     }

    //     //Cerrar modal
    //     $this->dispatchBrowserEvent('close-modal');
    // }

    public function cambiarEstatus(){

        $vacation = Vacation::where('id', $this->vacation->id)->first();

        if(isset($vacation->approval_jefe_id) && isset($vacation->approval_rh_id)){
            
            if($vacation->approval_jefe->aprobación == "Aprobado" && $vacation->approval_rh->aprobación == "Aprobado"){
                $vacation->estatus = 'Aprobado';
            }else{
                $vacation->estatus = 'No aprobado';
            }

            $vacation->save();
        }
    }

    public function render()
    {
        
        $hoy = Carbon::now()->format('Y-m-d');

        $json_dias = array();

        $json_dias[] = array(
            'title' => $this->vacation->motivo,
            'start' => date('Y-m-d\TH:i:s', strtotime($this->vacation->fecha_inicial->format('Y-m-d'))),
            'end' => date('Y-m-d\TH:i:s', strtotime($this->vacation->fecha_final->modify('+1 day')->format('Y-m-d'))),
            'allDay' => true,
            'color' => 'gray'
          );

        $justificarComoJefe = AreaUser::where('user_id', '=', $this->vacation->user->id)->where('encargado_id', '=', Auth::user()->id)->count();

        return view('livewire.admin.vacations.vacations-show', [
            'hoy' => $hoy,
            'json_dias' => $json_dias,
            'justificarComoJefe' => $justificarComoJefe
        ]);
    }
}
