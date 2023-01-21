<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\Area;
use App\Models\Company;
use App\Models\CostCenter;
use App\Models\Image;
use App\Models\Schedule;
use App\Models\User;
use App\Models\UserDocuments;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

use Illuminate\Support\Str;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;

class UsersCreate extends Component
{
    use WithFileUploads;

    //User
    public $foto, $qr, $name, $email, $curp, $código_del_país, $número_de_teléfono, $fecha_de_nacimiento, $número_de_empleado, $company, $cost_centers, $cost_center, $área, $encargado, $fecha_de_ingreso, $puesto, $tipo_de_puesto, $password, $password_confirmation, $role,
        $número_de_inscripción_al_imss, $rfc, $número_del_infonavit;

    //Schedule
    public $days = [];
    public $días_de_trabajo_a_la_semana, $hora_de_entrada, $hora_de_salida;

    //Docs
    public $documento_de_identificación_oficial, $documento_del_comprobante_de_domicilio, $documento_de_no_antecedentes_penales,
        $documento_de_la_licencia_de_conducir , $documento_de_la_cedula_profesional, $documento_de_la_carta_de_pasante, $documento_del_curriculum_vitae;

    public function rules(){
        
        $array = [];

        //User
        $array['foto'] = 'nullable|image|mimes:jpeg,jpg,png|max:5048';
        $array['name'] = 'required|string|max:255';
        $array['email'] = ['required', 'string', 'email', 'max:255', Rule::unique(User::class)];
        $array['número_de_empleado'] = 'required|numeric|max:99999999';

        if($this->código_del_país || $this->número_de_teléfono){
            $array['código_del_país'] = 'required|digits_between:1,3';
            $array['número_de_teléfono'] = 'required|digits:10';
        }

        $array['curp'] = ['required', 'string', 'min:18', 'max:18', /*'regex:/^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/',*/ 'unique:users,curp'];
        $array['fecha_de_nacimiento'] = 'nullable|date';
        $array['número_de_inscripción_al_imss'] = 'nullable|string|max:255';
        $array['rfc'] = ['required', /*'regex:/^([A-ZÑ&]{3,4}) ?(?:- ?)?(\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])) ?(?:- ?)?([A-Z\d]{2})([A\d])$/',*/ 'string','max:255'];
        $array['número_del_infonavit'] = 'nullable|string|max:255';

        //Work
        $array['número_de_empleado'] = 'required|numeric|max:99999999';
        $array['fecha_de_ingreso'] = 'nullable|date';
        $array['puesto'] = 'nullable|string|max:255';
        $array['tipo_de_puesto'] = 'nullable|string|max:255';
        $array['company'] = ['required'];
        $array['cost_center'] = ['nullable'];
        
        if($this->área || $this->encargado){
            $array['área'] = ['required'];
            $array['encargado'] = ['required'];
        }

        //Schedule
        if(count($this->days)){
            foreach($this->days as $n => $day){
                $array['hora_de_entrada.'.$n] = 'required';
                $array['hora_de_salida.'.$n] = 'required';
            }
        }

        //Docs
        $array['documento_de_identificación_oficial'] = ['nullable','mimes:jpg,jpeg,png,svg,pdf','max:6000'];
        $array['documento_del_comprobante_de_domicilio'] = ['nullable','mimes:jpg,jpeg,png,svg,pdf','max:6000'];
        $array['documento_de_no_antecedentes_penales'] = ['nullable','mimes:jpg,jpeg,png,svg,pdf','max:6000'];
        $array['documento_de_la_licencia_de_conducir'] = ['nullable','mimes:jpg,jpeg,png,svg,pdf','max:6000'];
        $array['documento_de_la_cedula_profesional'] = ['nullable','mimes:jpg,jpeg,png,svg,pdf','max:6000'];
        $array['documento_de_la_carta_de_pasante'] = ['nullable','mimes:jpg,jpeg,png,svg,pdf','max:6000'];
        $array['documento_del_curriculum_vitae'] = ['nullable','mimes:jpg,jpeg,png,svg,pdf','max:6000'];

        //Role
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

    public function updatedcompany($company){
        $this->cost_centers = CostCenter::where('company_id', $company)->orderBy('folio')->get();
        $this->cost_center = '';
    }

    protected $messages = [
        'hora_de_entrada.*.required' => 'La hora de entrada es obligatorio.',
        'hora_de_salida.*.required' => 'La hora de salida es obligatorio.',
    ];

    public function save(){

        $this->validate();


        //DOCS
        if($this->documento_de_identificación_oficial){
            $documento_de_identificación_oficial = $this->documento_de_identificación_oficial->store('identificaciones_oficiales');
        }else{
            $documento_de_identificación_oficial = null;
        }

        if($this->documento_del_comprobante_de_domicilio){
            $documento_del_comprobante_de_domicilio = $this->documento_del_comprobante_de_domicilio->store('comprobantes_de_domicilio');
        }else{
            $documento_del_comprobante_de_domicilio = null;
        }

        if(
        $this->documento_de_no_antecedentes_penales){
            $documento_de_no_antecedentes_penales = $this->documento_de_no_antecedentes_penales->store('documentos_de_no_antecedentes_penales');
        }else{
            $documento_de_no_antecedentes_penales = null;
        }

        if($this->documento_de_la_licencia_de_conducir){
            $documento_de_la_licencia_de_conducir = $this->documento_de_la_licencia_de_conducir->store('licencias_de_conducir');
        }else{
            $documento_de_la_licencia_de_conducir = null;
        }

        if($this->documento_de_la_cedula_profesional){
            $documento_de_la_cedula_profesional = $this->documento_de_la_cedula_profesional->store('cedulas_profesionales');
        }else{
            $documento_de_la_cedula_profesional = null;
        }

        if($this->documento_de_la_carta_de_pasante){
            $documento_de_la_carta_de_pasante = $this->documento_de_la_carta_de_pasante->store('cartas_de_pasantes');
        }else{
            $documento_de_la_carta_de_pasante = null;
        }

        if($this->documento_del_curriculum_vitae){
            $documento_del_curriculum_vitae = $this->documento_del_curriculum_vitae->store('curriculums_vitaes');
        }else{
            $documento_del_curriculum_vitae = null;
        }
        
        $document = UserDocuments::create([
            'documento_de_identificación_oficial' => $documento_de_identificación_oficial,
            'documento_del_comprobante_de_domicilio' => $documento_del_comprobante_de_domicilio,
            'documento_de_no_antecedentes_penales' => $documento_de_no_antecedentes_penales,
            'documento_de_la_licencia_de_conducir' => $documento_de_la_licencia_de_conducir,
            'documento_de_la_cedula_profesional' => $documento_de_la_cedula_profesional,
            'documento_de_la_carta_de_pasante' => $documento_de_la_carta_de_pasante,
            'documento_del_curriculum_vitae' => $documento_del_curriculum_vitae
        ]);
        


        if(isset($this->código_del_país) || isset($this->número_de_teléfono) && $this->código_del_país != '' && $this->número_de_teléfono != ''){
            $whatsapp = $this->código_del_país.$this->número_de_teléfono;
        }else{
            $whatsapp = null;
        }

        if($this->cost_center == ''){
            $cost_center = null;
        }else{
            $cost_center = $this->cost_center;
        }

        //USER  
        $user = User::create([
            'qr' => $this->qr,
            'name' => $this->name,
            'email' => $this->email,
            'curp' => $this->curp,
            'whatsapp' => $whatsapp,
            'fecha_de_nacimiento' => $this->fecha_de_nacimiento,
            'número_de_empleado' => $this->número_de_empleado,
            'fecha_de_ingreso' => $this->fecha_de_ingreso,
            'company_id' => $this->company,
            'cost_center_id' => $cost_center,
            'puesto' => $this->puesto,
            'tipo_de_puesto' => $this->tipo_de_puesto,
            'tipo' => 'Empleado',
            'password' => Hash::make($this->curp),
            //'password' => Hash::make($this->password),
            'estatus' => 'Activo',
            'número_de_inscripción_al_imss' => $this->número_de_inscripción_al_imss,
            'rfc' => $this->rfc,
            'número_del_infonavit' => $this->número_del_infonavit,
            'document_id' => $document->id,
            'slug' => Str::random(30)
        ]);

        //ÁREA Y ENCARGADO
        if($this->área || $this->encargado){
            $user->areas()->sync($this->área, ['encargado_id' => $this->encargado]);
        }


        if($this->foto){
            //FOTO
            Image::create([
                'url' => $this->foto->store('fotos'),
                'imageable_id' => $user->id,
                'imageable_type' => 'App\Models\User'
            ]);
        }
        

        //SCHEDULE
        if(count($this->days)){
            foreach($this->days as $n => $day){
                Schedule::create([
                    'día' => $day,
                    'hora_de_entrada' => $this->hora_de_entrada[$n],
                    'hora_de_salida' => $this->hora_de_salida[$n],
                    'turno' => null,
                    'user_id' => $user->id,
                    'posición' => $n+1,
                    'actual' => true
                ]);
            }
        }

        $user->roles()->sync($this->role);

        session()->flash('message', 'Empleado creado satisfactoriamente.');
        return redirect(route('admin.users.index'));
    }

    public function render()
    {
        $companies = Company::orderBy('nombre_de_la_compañia')->get();
        //$cost_centers = CostCenter::orderBy('folio')->get();
        $roles = Role::orderBy('name')->get();
        $areas = Area::orderBy('área')->get();
        $users = User::orderBy('name')->get();
        return view('livewire.admin.users.users-create',[
            'companies' => $companies,
            //'cost_centers' => $cost_centers,
            'roles' => $roles,
            'areas' => $areas,
            'users' => $users,
        ]);
    }
}