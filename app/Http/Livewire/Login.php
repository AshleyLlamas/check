<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email, $curp, $password, $key;

    protected $queryString = ['email', 'curp'];

    public function mount(){
        $this->key = 1;
    }

    public function rules(){

        $array = [];

        $array['email'] = 'required|email|max:255';

        switch($this->key){
            case 1:
                $array['curp'] = ['required', 'string', 'min:18', 'max:18', 'regex:/^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/'];
            break;
            case 2:
                $array['password'] = 'required|max:255';
            break;
            default:
                dd('ERROR - CONTACTESE CON EL ADMINISTRADOR');
            break;
        }

        return $array;
    }

    public function cambiarKey(){
        switch($this->key){
            case 1:
                $this->key = 2;
            break;
            case 2:
                $this->key = 1;
            break;
            default:
                dd('ERROR - CONTACTESE CON EL ADMINISTRADOR');
            break;
        }
    }

    public function save(){

        $this->validate();

        switch($this->key){
            case 1:
                //CURP
                $password = $this->curp;
            break;
            case 2:
                //PASSWORD
                $password = $this->password;
            break;
            default:
                dd('ERROR - CONTACTESE CON EL ADMINISTRADOR');
            break;
        }

        if(Auth::attempt(array('email' => $this->email, 'password' => $password))){

            if(isset(Auth::user()->image) || Auth::user()->id == 1){
                return redirect()->route('profile');
            }else{
                Auth::logout();
                session()->flash('error', 'El usuario no cuenta con fotografía, contáctese con el administrador.');
                return redirect()->route('login');
            }
        }else{
            session()->flash('error', 'Estas credenciales no coinciden con nuestros registros.');
        }
    }

    public function render()
    {
        return view('livewire.login');
    }
}
