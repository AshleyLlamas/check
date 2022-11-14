<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\Company;
use App\Models\Image;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;

class UsersEdit extends Component
{
    use WithFileUploads;

    public $user;

    //User
    public $foto, $qr, $name, $email, $curp, $número_de_empleado, $company, $puesto, $password, $password_confirmation, $role;

    public function mount(User $user){
        $this->user = $user;

        $this->user->name = $user->name;
        $this->email = $user->email;
        $this->curp = $user->curp;
        $this->company = $user->company_id;

        if($user->roles->count()){
            $this->role = $user->roles->pluck('id')[0];
        }
    }

    public function rules(){
        
        $array = [];

        $array['foto'] = 'nullable|image|mimes:jpeg,jpg,png|max:5048';
        $array['user.name'] = 'required|string|max:255';
        $array['user.número_de_empleado'] = 'required|numeric|max:99999';
        $array['curp'] = ['required', 'string', 'min:18', 'max:18', 'regex:/^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/', 'unique:users,curp,'.$this->user->id];
        $array['email'] = ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$this->user->id];

        $array['user.puesto'] = 'nullable|string|max:255';
        $array['company'] = ['required'];

        $array['role'] = ['required'];
    
        return $array;
    }

    public function updatedemail($email){
        $this->qr = 'email='.$this->email.'&curp='.$this->curp;
    }

    public function updatedcurp($curp){
        $this->qr = 'email='.$this->email.'&curp='.$this->curp;
    }

    public function save(){

        $this->validate();

        if($this->foto){
            if($this->user->image){
                //Si el usuario tiene imagen elimina y actualiza
                Storage::delete($this->user->image->url); //Elimino

                $this->user->image->update([ //Actualizo
                    'url' => $this->foto->store('fotos'), //Guardo
                ]);
            }else{
                //Si el usuario no tiene imagen, cree una
                Image::create([
                    'url' => $this->foto->store('fotos'),
                    'imageable_id' => $this->user->id,
                    'imageable_type' => 'App\Models\User'
                ]);
            }

        }

        $this->user->qr = $this->qr;
        $this->user->email = $this->email;
        $this->user->curp = $this->curp;
        $this->user->password = Hash::make(mb_strtoupper($this->curp, 'UTF-8'));
        $this->user->company_id = $this->company;

        //$user->roles()->detach();
        $this->user->roles()->sync($this->role);
        $this->user->save();

        session()->flash('message', 'Usuario se editó satisfactoriamente.');

        return redirect(route('admin.users.index'));
    }

    public function render()
    {
            $companies = Company::orderBy('nombre_de_la_compañia')->get();
            $roles = Role::orderBy('name')->get();

        return view('livewire.admin.users.users-edit', [
            'companies' => $companies,
            'roles' => $roles
        ]);
    }
}
