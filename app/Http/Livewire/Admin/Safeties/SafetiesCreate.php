<?php

namespace App\Http\Livewire\Admin\Safeties;

use App\Models\Area;
use App\Models\Image;
use App\Models\Safety;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class SafetiesCreate extends Component
{
    use WithFileUploads;

    public $tipo, $user, $area, $fecha, $evidencia, $afectados, $descripción;

    //Images
    public $n = 0;

    public function rules(){

        $array = [];

        $array['area'] = "nullable";
        $array['tipo'] = "required|in:Fatalidad,Primeros auxilios,Accidentes de trabajo,Incidentes a la propiedad,Incidentes ambientables,No hubo incidencias";
        $array['fecha'] = 'required|date|before:tomorrow';

        //$array['n'] = 'required|numeric|min:1|max:5';

        for($i = 1; $i <= $this->n; $i++){
            $array['evidencia.'.$i] = 'required|image|mimes:jpeg,jpg,png|max:7048';
        }

        $array['descripción'] = ['nullable', 'string', 'max:429496729'];

        return $array;
    }

    protected $messages = [
        'n.min' => 'Se necesita como minimo 1 evidencia.',
        'n.max' => 'Se necesita como máximo 5 evidencias.',
        'evidencia.*.required' => 'La evidencia es requerida.',
    ];


    public function remove($n){
        $this->n = $n-1;
    }

    public function add($n)
    {
        $this->n = $n+1;
    }

    public function save(){

        $this->validate();        

        if($this->area == ''){
            $this->area = null;
        }

        $safety = Safety::create([
            'tipo' => $this->tipo,
            'user_id' => Auth::id(),
            'area_id' => $this->area,
            'fecha' => $this->fecha,
            'descripción' => $this->descripción
        ]);

        for($i = 1; $i <= $this->n; $i++){

            Image::create([
                'url' => $this->evidencia[$i]->storeAs("evidencias", $this->evidencia[$i]->store(null), "private"),
                'imageable_id' => $safety->id,
                'imageable_type' => Safety::class
            ]);
        }

        $safety->users()->attach($this->afectados);

        session()->flash('message', 'Incidencia creada satisfactoriamente.');
        return redirect(route('admin.safeties.index'));
    }

    public function render()
    {
        $areas = Area::orderBy('área')->get();
        $users = User::orderBy('name')->get();
        
        return view('livewire.admin.safeties.safeties-create', [
            'areas' => $areas,
            'users' => $users
        ]);
    }
}
