<?php

namespace App\Http\Livewire\Admin\Assistances;

use App\Models\Approval;
use App\Models\Assistance;
use App\Models\JustifyAttendance;
use Livewire\Component;

class AssistancesShow extends Component
{
    public $assistance; 

    public $tipo;
    
    public $aprobación, $observaciones;

    protected $listeners = ['render', 'createApprovalJefe'];

    public function createApprovalJefe()
    {

        if(!isset($this->assistance->justify_attendance->approval_jefe_id)){
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

            $this->assistance->justify_attendance->approval_jefe_id = $approval->id;
            $this->assistance->justify_attendance->save();
    
            $this->aprobación = '';
            $this->observaciones = '';

            $this->cambiarEstatus();

            session()->flash('message', 'Aprobación creado satisfactoriamente.');
        }

        //Cerrar modal
        $this->dispatchBrowserEvent('close-modal');
    }

    public function createJustifyAttendance(){
        if(!isset($this->assistance->justify_attendance)){
            JustifyAttendance::create([
                'assistance_id' => $this->assistance->id,
                'tipo' => $this->tipo,
                'user_id' => null, // Quien lo solicito??
                'estatus' => 'En espera'
            ]);
    
            session()->flash('message', 'Justificante creado satisfactoriamente.');
        }

        $this->dispatchBrowserEvent('close-modal');
    }

    public function createApprovalRh()
    {

        if(!isset($this->assistance->justify_attendance->approval_rh_id)){
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

            $this->assistance->justify_attendance->approval_rh_id = $approval->id;
            $this->assistance->justify_attendance->save();
    
            $this->aprobación = '';
            $this->observaciones = '';

            $this->cambiarEstatus();

            session()->flash('message', 'Aprobación creado satisfactoriamente.');
        }

        //Cerrar modal
        $this->dispatchBrowserEvent('close-modal');
    }

    public function cambiarEstatus(){

        $justify_attendance = JustifyAttendance::where('id', $this->assistance->justify_attendance->id)->first();

        if(isset($justify_attendance->approval_jefe_id) && isset($justify_attendance->approval_rh_id)){
            
            if($justify_attendance->approval_jefe->aprobación == "Aprobado" && $justify_attendance->approval_rh->aprobación == "Aprobado"){
                $justify_attendance->estatus = 'Aprobado';
            }else{
                $justify_attendance->estatus = 'No aprobado';
            }

            $justify_attendance->save();
        }
    }

    public function render()
    {
        return view('livewire.admin.assistances.assistances-show');
    }
}
