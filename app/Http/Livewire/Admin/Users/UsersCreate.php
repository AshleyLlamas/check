<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\Company;
use App\Models\Image;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

use Livewire\Component;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;

class UsersCreate extends Component
{
    use WithFileUploads;

    //User
    public $foto, $qr, $name, $email, $curp, $número_de_empleado, $company, $puesto, $password, $password_confirmation, $role;

    //Schedule
    public $days = [];
    public $días_de_trabajo_a_la_semana, $hora_de_entrada, $hora_de_salida;

    public function rules(){
        
        $array = [];

        $array['foto'] = 'required|image|mimes:jpeg,jpg,png|max:5048';
        $array['name'] = 'required|string|max:255';
        $array['número_de_empleado'] = 'required|numeric|max:99999';
        $array['email'] = ['required', 'string', 'email', 'max:255', Rule::unique(User::class)];
        $array['curp'] = ['required', 'string', 'min:18', 'max:18', 'regex:/^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/', 'unique:users,curp'];

        $array['puesto'] = 'nullable|string|max:255';
        $array['company'] = ['required'];

        if(count($this->days)){
            foreach($this->days as $n => $day){
                $array['hora_de_entrada.'.$n] = 'required';
                $array['hora_de_salida.'.$n] = 'required';
            }
        }

        $array['role'] = ['required'];

       //$array['password'] = 'required|confirmed';
    
        return $array;
    }

    //$_SERVER['SERVER_NAME'] test.test

    public function updatedemail($email){
        $this->qr = 'email='.$this->email.'&curp='.$this->curp;
    }

    public function updatedcurp($curp){
        $this->qr = 'email='.$this->email.'&curp='.$this->curp;
    }

    protected $messages = [
        'hora_de_entrada.*.required' => 'La hora de entrada es obligatorio.',
        'hora_de_salida.*.required' => 'La hora de salida es obligatorio.',
    ];

    public function save(){
        $this->validate();

        $user = User::create([
            'qr' => $this->qr,
            'name' => $this->name,
            'email' => $this->email,
            'curp' => $this->curp,
            'número_de_empleado' => $this->número_de_empleado,
            'company_id' => $this->company,
            'puesto' => $this->puesto,
            'password' => Hash::make($this->curp),
            //'password' => Hash::make($this->password),
            'estatus' => 'N/A'
        ]);

        //FOTO
        Image::create([
            'url' => $this->foto->store('fotos'),
            'imageable_id' => $user->id,
            'imageable_type' => 'App\Models\User'
        ]);

        foreach($this->days as $n => $day){
            Schedule::create([
                'día' => $day,
                'hora_de_entrada' => $this->hora_de_entrada[$n],
                'hora_de_salida' => $this->hora_de_salida[$n],
                'turno' => null,
                'user_id' => $user->id,
                'actual' => true
            ]);
        }

        $user->roles()->sync($this->role);

        session()->flash('message', 'Usuario creado satisfactoriamente.');

        return redirect(route('admin.users.index'));
    }

    public function render()
    {
        $companies = Company::orderBy('nombre_de_la_compañia')->get();
        $roles = Role::orderBy('name')->get();

        return view('livewire.admin.users.users-create',[
            'companies' => $companies,
            'roles' => $roles
        ]);
    }
}