<?php

namespace App\Http\Livewire\Admin\NonWorkingDays;

use App\Models\NonWorkingDay;
use Livewire\Component;

class NonWorkingDaysCreate extends Component
{
    public $fecha, $razón, $sueldo = 'Sin gose', $multiplicador = 1;

    public function rules(){

        $array = [];

        $array['razón'] = 'required|string|max:255';

        $array['fecha'] = 'required|unique:non_working_days';
        $array['sueldo'] = 'nullable';
        $array['multiplicador'] = 'nullable';

        return $array;
    }

    public function save(){
        $this->validate();

        NonWorkingDay::create([
            'fecha' => $this->fecha,
            'razón' =>$this->razón,
            'sueldo' => $this->sueldo,
            'multiplicador' => $this->multiplicador
        ]);

        session()->flash('message', 'Día no laboral agregado al calendario satisfactoriamente.');

        return redirect(route('admin.calendars.index'));

    }

    public function render()
    {
        return view('livewire.admin.non-working-days.non-working-days-create');
    }
}
