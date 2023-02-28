<?php

namespace App\Http\Livewire\Admin\NonWorkingDays;

use App\Models\NonWorkingDay;
use Livewire\Component;

class NonWorkingDaysEdit extends Component
{
    public $nonWorkingDay;

    public $fecha, $sueldo, $multiplicador;

    public function mount(NonWorkingDay $nonWorkingDay){
        $this->nonWorkingDay = $nonWorkingDay;

        $this->fecha = $nonWorkingDay->fecha->format('Y-m-d');
        $this->sueldo = $nonWorkingDay->sueldo;
        $this->multiplicador = $nonWorkingDay->multiplicador;
    }

    public function rules(){

        $array = [];

        $array['nonWorkingDay.razón'] = 'required|string|max:255';

        $array['fecha'] = 'required|unique:non_working_days,fecha,'.$this->nonWorkingDay->id;
        $array['sueldo'] = 'required';
        $array['multiplicador'] = 'required';

        return $array;
    }

    public function save(){
        $this->validate();

        $this->nonWorkingDay->fecha = $this->fecha;
        $this->nonWorkingDay->sueldo = $this->sueldo;
        $this->nonWorkingDay->multiplicador = $this->multiplicador;

        $this->nonWorkingDay->save();

        session()->flash('message', 'Día no laboral se editó satisfactoriamente.');

        return redirect(route('admin.calendars.index'));
    }

    public function render()
    {
        return view('livewire.admin.non-working-days.non-working-days-edit');
    }
}
