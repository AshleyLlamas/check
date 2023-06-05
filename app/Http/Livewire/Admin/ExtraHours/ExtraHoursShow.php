<?php

namespace App\Http\Livewire\Admin\ExtraHours;

use App\Models\Approval;
use App\Models\AreaUser;
use App\Models\ExtraHour;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ExtraHoursShow extends Component
{

    public $extraHour;

    public $aprobación, $observaciones;


    public function createApprovalJefe()
    {

        if(!isset($this->extraHour->approval_jefe_id)){
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

            $this->extraHour->approval_jefe_id = $approval->id;
            $this->extraHour->save();

            $this->aprobación = '';
            $this->observaciones = '';

            $this->cambiarEstatus();

            session()->flash('message', 'Aprobación creado satisfactoriamente.');
        }

        //Cerrar modal
        $this->dispatchBrowserEvent('close-modal');
    }

    //Se elimino
    // public function createApprovalRh()
    // {

    //     if(!isset($this->extraHour->approval_rh_id)){
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

    //         $this->extraHour->approval_rh_id = $approval->id;
    //         $this->extraHour->save();

    //         $this->aprobación = '';
    //         $this->observaciones = '';

    //         $this->cambiarEstatus();

    //         session()->flash('message', 'Aprobación creado satisfactoriamente.');
    //     }

    //     //Cerrar modal
    //     $this->dispatchBrowserEvent('close-modal');
    // }

    public function createApprovalDg()
    {

        if(!isset($this->extraHour->approval_dg_id)){
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

            $this->extraHour->approval_dg_id = $approval->id;
            $this->extraHour->save();

            $this->aprobación = '';
            $this->observaciones = '';

            $this->cambiarEstatus();

            session()->flash('message', 'Aprobación creado satisfactoriamente.');
        }

        //Cerrar modal
        $this->dispatchBrowserEvent('close-modal');
    }

    public function cambiarEstatus(){

        $extraHour = ExtraHour::where('id', $this->extraHour->id)->first();

        if(isset($extraHour->approval_jefe_id) && isset($extraHour->approval_dg_id)){

            if($extraHour->approval_jefe->aprobación == "Aprobado" && $extraHour->approval_dg->aprobación == "Aprobado"){
                $extraHour->estatus = 'Aprobado';
            }else{
                $extraHour->estatus = 'No aprobado';
            }

            $extraHour->save();
        }
    }

    public function render()
    {
        $justificarComoJefe = AreaUser::where('user_id', '=', $this->extraHour->user->id)->where('encargado_id', '=', Auth::user()->id)->count();

        return view('livewire.admin.extra-hours.extra-hours-show', [
            'justificarComoJefe' => $justificarComoJefe 
        ]);
    }
}
