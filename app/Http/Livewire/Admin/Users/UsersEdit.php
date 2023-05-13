<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\Area;
use App\Models\Company;
use App\Models\CostCenter;
use App\Models\DefaultSchedule;
use App\Models\Image;
use App\Models\Schedule;
use App\Models\User;
use App\Models\UserSetting;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;

class UsersEdit extends Component
{
    use WithFileUploads;

    public $user, $document;

    //User
    public $foto, $qr, $name, $email, $curp, $fecha_de_nacimiento, $código_del_país, $número_de_teléfono, $número_de_empleado, $fecha_de_ingreso, $company, $cost_centers, $cost_center, $área, $encargado, $puesto, $tipo_de_puesto, $tipo, $derecho_a_hora_extra, $recontratable, $estatus, $password, $password_confirmation, $role;

    public $documento_de_identificación_oficial, $documento_del_comprobante_de_domicilio, $documento_de_no_antecedentes_penales,
        $documento_de_la_licencia_de_conducir , $documento_de_la_cedula_profesional, $documento_de_la_carta_de_pasante, $documento_del_curriculum_vitae, $documento_del_contrato;

    //HORARIO
    public $days = [];
    public $hora_de_entrada, $hora_de_salida;

    //HORARIO PREDETERMINADO
    public $horario_predeterminado;

    public function mount(User $user){
        $this->user = $user;
        $this->document = $user->document;

        $this->qr = $user->qr;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->curp = $user->curp;
        $this->fecha_de_nacimiento = $user->fecha_de_nacimiento;
        $this->código_del_país = substr($user->whatsapp, 0, -10);
        $this->número_de_teléfono = substr($user->whatsapp, -10);
        $this->fecha_de_ingreso = $user->fecha_de_ingreso;
        $this->tipo_de_puesto = $this->user->tipo_de_puesto;

        if(isset($user->company_id)){
            $this->cost_centers = CostCenter::where('company_id', $user->company_id)->orderBy('folio')->get();
        }

        if(isset($user->userSetting)){
            $this->derecho_a_hora_extra = $user->userSetting->derecho_a_hora_extra;
            $this->recontratable = $user->userSetting->recontratable;
        }

        $this->estatus = $user->estatus;

        $this->cost_center = $this->user->cost_center_id;

        if($user->areas->count()){
            $pivot = $user->areas->first()->pivot;

            if($pivot != null){
                $this->área = $pivot->area_id;
                $this->encargado = $pivot->encargado_id;
            }
        }

        $this->company = $user->company_id;
        $this->tipo = $user->tipo;

        if($user->roles->count()){
            $this->role = $user->roles->pluck('id')[0];
        }

        $schedules = Schedule::where('scheduleble_id', $user->id)->where('scheduleble_type', User::class)->orderBy('posición', 'asc');

        $this->days = $schedules->pluck('día')->toArray();

        foreach($schedules->get() as $i => $day){
            $this->hora_de_entrada[$i] = $day->hora_de_entrada->format('H:i');
            $this->hora_de_salida[$i] = $day->hora_de_salida->format('H:i');
        }
    }

    public function updatedcompany($company){
        $this->cost_centers = CostCenter::where('company_id', $company)->orderBy('folio')->get();
        $this->cost_center = '';
    }

    public function updatedhorariopredeterminado($horario_predeterminado){
        if($horario_predeterminado != ""){
            $default_schedule = DefaultSchedule::where('id', $horario_predeterminado)->first();

            $schedules = Schedule::where('scheduleble_id', $default_schedule->id)->where('scheduleble_type', DefaultSchedule::class)->orderBy('posición', 'asc');

            $this->hora_de_entrada = [];
            $this->hora_de_salida = [];

            $this->days = $schedules->pluck('día')->toArray();

            foreach($schedules->get() as $i => $day){
                $this->hora_de_entrada[$i] = $day->hora_de_entrada->format('H:i');
                $this->hora_de_salida[$i] = $day->hora_de_salida->format('H:i');
            }

        }else{
            $this->days = [];
            $this->hora_de_entrada = [];
            $this->hora_de_salida = [];
        }
    }

    public function rules(){

        $array = [];

        //User
        $array['foto'] = 'nullable|image|mimes:jpeg,jpg,png|max:5048';
        $array['user.name'] = 'required|string|max:255';
        $array['curp'] = ['required', 'string', 'min:18', 'max:18', 'unique:users,curp,'.$this->user->id];
        $array['fecha_de_nacimiento'] = 'nullable|date';

        if($this->código_del_país || $this->número_de_teléfono){
            $array['código_del_país'] = 'required|digits_between:1,3';
            $array['número_de_teléfono'] = 'required|digits:10';
        }

        $array['email'] = ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$this->user->id];
        $array['user.número_de_inscripción_al_imss'] = 'nullable|string|max:255';
        $array['user.rfc'] = ['required',/* 'regex:/^([A-ZÑ&]{3,4}) ?(?:- ?)?(\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])) ?(?:- ?)?([A-Z\d]{2})([A\d])$/',*/'string','max:255'];
        $array['user.número_del_infonavit'] = 'nullable|string|max:255';

        //Work
        $array['user.número_de_empleado'] = 'required|numeric|max:99999999|unique:users,número_de_empleado,'.$this->user->id;
        $array['user.puesto'] = 'nullable|string|max:255';
        $array['tipo_de_puesto'] = 'nullable|string|max:255';
        $array['company'] = ['required'];
        $array['cost_center'] = ['nullable'];
        $array['tipo'] = ['required'];

        //User Settings
        $array['derecho_a_hora_extra'] = "required|in:Si,No";
        $array['recontratable'] = "required|in:Si,No";

        $array['estatus'] = "required|in:Activo,Inactivo,Baja definitiva";

        //Horario
        $array['days'] = "nullable";

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
        $array['documento_del_contrato'] = ['nullable','mimes:jpg,jpeg,png,svg,pdf','max:6000'];

        $array['role'] = ['required'];

        return $array;
    }

    protected $messages = [
        'tipo.required' => 'El campo estatus es requerido.',
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

        if($this->derecho_a_hora_extra){
            if(isset($this->user->userSetting)){
                $this->user->userSetting->derecho_a_hora_extra = $this->derecho_a_hora_extra;
                $this->user->userSetting->recontratable = $this->recontratable;
                $this->user->userSetting->save();
            }else{
                UserSetting::create([
                    'derecho_a_hora_extra' => $this->derecho_a_hora_extra,
                    'recontratable' => $this->recontratable,
                    'user_id' => $this->user->id
                ]);
            }
        }else{
            if(!isset($this->user->userSetting)){
                UserSetting::create([
                    'derecho_a_hora_extra' => 'No',
                    'recontratable' => 'Si',
                    'user_id' => $this->user->id
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

        if($this->documento_del_contrato){
            Storage::delete([$this->document->documento_del_contrato]);
            $this->document->documento_del_contrato = $this->documento_del_contrato->store('contratos');
        }

        if(isset($this->user->document)){
            $this->user->document->save();
        }

        if($this->código_del_país != null || $this->número_de_teléfono != null && $this->código_del_país != '' && $this->número_de_teléfono != ''){
            $whatsapp = $this->código_del_país.$this->número_de_teléfono;
        }else{
            $whatsapp = null;
        }

        if($this->cost_center == ""){
            $this->cost_center = null;
        }

        $this->user->qr = $this->qr;
        $this->user->email = $this->email;
        $this->user->curp = $this->curp;
        $this->user->fecha_de_nacimiento = $this->fecha_de_nacimiento;
        $this->user->whatsapp = $whatsapp;
        $this->user->password = Hash::make(mb_strtoupper($this->curp, 'UTF-8'));
        $this->user->fecha_de_ingreso = $this->fecha_de_ingreso;
        $this->user->tipo_de_puesto = $this->tipo_de_puesto;
        $this->user->company_id = $this->company;
        $this->user->cost_center_id = $this->cost_center;
        $this->user->tipo = $this->tipo;

        $this->user->estatus = $this->estatus;

        //$user->roles()->detach();
        $this->user->areas()->syncWithPivotValues($this->área, ['encargado_id' => $this->encargado]);
        $this->user->roles()->sync($this->role);
        $this->user->save();
        $this->document->save();

        //Actualizar horario
        $where_not_in_schedule = Schedule::where('scheduleble_id', $this->user->id)->where('scheduleble_type', User::class)->whereNotIn('día', $this->days);

        $where_not_in_schedule->delete();

        foreach($this->days as $n => $day){
            $schedule = Schedule::where('scheduleble_id', $this->user->id)->where('scheduleble_type', User::class)->where('día', $day)->first();

            //Si no existe crear un nuevo SCHEDULE
            if(is_null($schedule)){
                Schedule::create([
                    'día' => $day,
                    'hora_de_entrada' => $this->hora_de_entrada[$n],
                    'hora_de_salida' => $this->hora_de_salida[$n],
                    'turno' => null,
                    //'user_id' => $user->id,
                    'scheduleble_id' => $this->user->id,
                    'scheduleble_type' => User::class,
                    'posición' => $n+1,
                    'actual' => true
                ]);
            }else{
                $schedule->hora_de_entrada = $this->hora_de_entrada[$n];
                $schedule->hora_de_salida = $this->hora_de_salida[$n];
                $schedule->posición = $n+1;
                $schedule->save();
            }
        }

        session()->flash('message', 'Empleado se editó satisfactoriamente.');

        return redirect(route('admin.users.index'));
    }

    public function render()
    {
            $companies = Company::orderBy('nombre_de_la_compañia')->get();
            $cost_centers = CostCenter::orderBy('folio')->get();
            $areas = Area::orderBy('área')->get();
            $users = User::orderBy('name')->get();
            $roles = Role::orderBy('name')->get();

            $default_schedules = DefaultSchedule::orderBy('nombre_del_horario')->get();

        return view('livewire.admin.users.users-edit', [
            'companies' => $companies,
            'cost_centers' => $cost_centers,
            'areas' => $areas,
            'roles' => $roles,
            'users' => $users,
            'default_schedules' => $default_schedules
        ]);
    }
}
