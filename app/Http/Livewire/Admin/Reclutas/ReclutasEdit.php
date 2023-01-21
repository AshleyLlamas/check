<?php

namespace App\Http\Livewire\Admin\Reclutas;

use App\Models\Company;
use App\Models\Image;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ReclutasEdit extends Component
{
    use WithFileUploads;

    public $user, $document;

    //User
    public $foto, $qr, $name, $email, $curp, $company, $puesto, $tipo_de_puesto, $tipo;

    public $documento_de_identificación_oficial, $documento_del_comprobante_de_domicilio, $documento_de_no_antecedentes_penales,
        $documento_de_la_licencia_de_conducir , $documento_de_la_cedula_profesional, $documento_de_la_carta_de_pasante, $documento_del_curriculum_vitae;
    
    public function mount(User $user){
        $this->user = $user;
        $this->document = $user->document;
    
        $this->qr = $user->qr;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->curp = $user->curp;
        $this->tipo_de_puesto = $this->user->tipo_de_puesto;
        $this->company = $user->company_id;
        $this->tipo = $user->tipo;
    }

    public function rules(){
        
        $array = [];

        //User
        $array['foto'] = 'nullable|image|mimes:jpeg,jpg,png|max:5048';
        $array['user.name'] = 'required|string|max:255';
        $array['curp'] = ['required', 'string', 'min:18', 'max:18', 'regex:/^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/', 'unique:users,curp,'.$this->user->id];
        $array['email'] = ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$this->user->id];
        $array['user.número_de_inscripción_al_imss'] = 'nullable|string|max:255';
        $array['user.rfc'] = ['required',/* 'regex:/^([A-ZÑ&]{3,4}) ?(?:- ?)?(\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])) ?(?:- ?)?([A-Z\d]{2})([A\d])$/',*/'string','max:255'];
        $array['user.número_del_infonavit'] = 'nullable|string|max:255';

        //Work
        $array['user.puesto'] = 'nullable|string|max:255';
        $array['tipo_de_puesto'] = 'nullable|string|max:255';
        $array['company'] = ['required'];
        $array['tipo'] = ['required'];

        //Docs
        $array['documento_de_identificación_oficial'] = ['nullable','mimes:jpg,jpeg,png,svg,pdf','max:6000'];
        $array['documento_del_comprobante_de_domicilio'] = ['nullable','mimes:jpg,jpeg,png,svg,pdf','max:6000'];
        $array['documento_de_no_antecedentes_penales'] = ['nullable','mimes:jpg,jpeg,png,svg,pdf','max:6000'];
        $array['documento_de_la_licencia_de_conducir'] = ['nullable','mimes:jpg,jpeg,png,svg,pdf','max:6000'];
        $array['documento_de_la_cedula_profesional'] = ['nullable','mimes:jpg,jpeg,png,svg,pdf','max:6000'];
        $array['documento_de_la_carta_de_pasante'] = ['nullable','mimes:jpg,jpeg,png,svg,pdf','max:6000'];
        $array['documento_del_curriculum_vitae'] = ['nullable','mimes:jpg,jpeg,png,svg,pdf','max:6000'];
    
        return $array;
    }

    protected $messages = [
        'tipo.required' => 'El campo estatus es requerido.'
    ];

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

        //Docs
        if($this->documento_de_identificación_oficial){
            Storage::delete([$this->document->documento_de_identificación_oficial]);
            $this->document->documento_de_identificación_oficial = $this->documento_de_identificación_oficial->store('identificaciones_oficiales');
        }

        if($this->documento_del_comprobante_de_domicilio){
            Storage::delete([$this->document->documento_del_comprobante_de_domicilio]);
            $this->document->documento_del_comprobante_de_domicilio = $this->documento_del_comprobante_de_domicilio->store('comprobantes_de_domicilio');
        }

        if($this->documento_de_no_antecedentes_penales){
            Storage::delete([$this->document->documento_de_no_antecedentes_penales]);
            $this->document->documento_de_no_antecedentes_penales = $this->documento_de_no_antecedentes_penales->store('documentos_de_no_antecedentes_penales');
        }

        if($this->documento_de_la_licencia_de_conducir){
            Storage::delete([$this->document->documento_de_la_licencia_de_conducir]);
            $this->document->documento_de_la_licencia_de_conducir = $this->documento_de_la_licencia_de_conducir->store('licencias_de_conducir');
        }

        if($this->documento_de_la_cedula_profesional){
            Storage::delete([$this->document->documento_de_la_cedula_profesional]);
            $this->document->documento_de_la_cedula_profesional = $this->documento_de_la_cedula_profesional->store('cedulas_profesionales');
        }

        if($this->documento_de_la_carta_de_pasante){
            Storage::delete([$this->document->documento_de_la_carta_de_pasante]);
            $this->document->documento_de_la_carta_de_pasante = $this->documento_de_la_carta_de_pasante->store('cartas_de_pasantes');
        }

        if($this->documento_del_curriculum_vitae){
            Storage::delete([$this->document->documento_del_curriculum_vitae]);
            $this->document->documento_del_curriculum_vitae = $this->documento_del_curriculum_vitae->store('curriculums_vitaes');
        }

        $this->user->qr = $this->qr;
        $this->user->email = $this->email;
        $this->user->curp = $this->curp;
        $this->user->password = Hash::make(mb_strtoupper($this->curp, 'UTF-8'));
        $this->user->tipo_de_puesto = $this->tipo_de_puesto;
        $this->user->company_id = $this->company;
        $this->user->tipo = $this->tipo;

        $this->user->save();
        $this->document->save();

        session()->flash('message', 'Reclutado se editó satisfactoriamente.');

        return redirect(route('admin.reclutas.index'));
    }

    public function render()
    {
        $companies = Company::orderBy('nombre_de_la_compañia')->get();
        
        return view('livewire.admin.reclutas.reclutas-edit', [
            'companies' => $companies
        ]);
    }
}
