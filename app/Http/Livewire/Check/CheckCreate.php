<?php

namespace App\Http\Livewire\Check;

use App\Models\Assistance;
use App\Models\Check;
use App\Models\Schedule;
use App\Models\TimeCheck;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

use Rats\Zkteco\Lib\ZKTeco;

class CheckCreate extends Component
{
    public $user;

    public $existe_un_check;

    public function mount(User $user){
        $this->existe_un_check = Check::where('user_id', $user->id)->where('fecha', Carbon::now()->formatLocalized('%Y-%m-%d'))->get()->last();
        $zk = new ZKTeco('34.195.118.113', 9892);

        $zk->connect();   

        //$zk->testVoice();

        $zk->getUser(); 
    }

    public function save(){

        switch(substr(Carbon::now()->formatLocalized('%A'), 0, 2)){
            case "lu":
                $clave = "Lunes";
            break;
            case "ma":
                $clave = "Martes";
            break;
            case "mi":
                $clave = "Miércoles";
            break;
            case "ju":
                $clave = "Jueves";
            break;
            case "vi":
                $clave = "Viernes";
            break;
            case "sa":
                $clave = "Sábado";
            break;
            case "do":
                $clave = "Domingo";
            break;
        }

        $fecha_a_comparar = Schedule::where('user_id', $this->user->id)->where('día', $clave)->get()->last();

        //El usuario tiene compañia?
        if($this->user->company){
            $company = $this->user->company->id;
        }else{
            $company = null;
        }

        if($this->existe_un_check){
            //Va de salida
            if($fecha_a_comparar){
                //Comparar para saber si sale antes
    
                if($fecha_a_comparar->hora_de_salida->getTimestamp() >= Carbon::now()->getTimestamp()){

                    $out_estatus = 'Salió antes de tiempo';
                    $out_observación = $fecha_a_comparar->hora_de_salida->diff(Carbon::now())->format('por %h horas %i minutos con %s segundos');
                }else{
                    $out_estatus = 'Salió despues';
                    $out_observación = $fecha_a_comparar->hora_de_salida->diff(Carbon::now())->format('por %h horas %i minutos con %s segundos');
                }
    
                $out = TimeCheck::create([
                    'hora' => Carbon::now(),
                    'estatus' => $out_estatus,
                    'observación' => $out_observación
                ]);

                if($this->existe_un_check->in == 'Llego tarde'){
                    $asistencia = 'Con retardo';
                }else{
                    $asistencia = 'Asistió';
                }
                
    
                $this->existe_un_check->out_id = $out->id;
                $this->existe_un_check->save();

                Assistance::create([
                    'check_id' => $this->existe_un_check->id,
                    'user_id' => $this->user->id,
                    'asistencia' => $asistencia,
                    'observación' => 'Asistencia completa'
                ]);
    
            }else{
                //Hoy no trabaja, agregar asistencia y notificar si es tiempo extra.
                
                $tiempo = $this->existe_un_check->in->created_at->diff(Carbon::now())->format('%h horas %i minutos con %s segundos');

                $out = TimeCheck::create([
                    'hora' => Carbon::now(),
                    'estatus' => 'Sin horario',
                    'observación' => 'Revisar si es tiempo extra'
                ]);

                $this->existe_un_check->out_id = $out->id;
                $this->existe_un_check->save();

                Assistance::create([
                    'check_id' => $this->existe_un_check->id,
                    'user_id' => $this->user->id,
                    'asistencia' => 'Asistió',
                    'observación' => 'Trabajo tiempo extra: '.$tiempo. 'desde el primer check'
                ]);
            }

        }else{
            //Apenas esta entrando
            if($fecha_a_comparar){

                if($fecha_a_comparar->hora_de_entrada->modify('+15 minute')->getTimestamp() >= Carbon::now()->getTimestamp()){
                    $in_estatus = 'Llego a tiempo';
                    $in_observación = 'Sin observación';
                }else{
                    $in_estatus = 'Llego tarde';
                    $in_observación = $fecha_a_comparar->hora_de_entrada->diff(Carbon::now())->format('por %h horas %i minutos con %s segundos');
                }
    
                $in = TimeCheck::create([
                    'hora' => Carbon::now(),
                    'estatus' => $in_estatus,
                    'observación' => $in_observación
                ]);
    
                Check::create([
                    'fecha' => Carbon::now(),
                    'in_id' => $in->id,
                    'out_id' => null,
                    'user_id' => $this->user->id,
                    'company_id' => $company,
                    'schedule_id' => $fecha_a_comparar->id
                ]);
    
            }else{
                //Hoy no trabaja, agregar asistencia y notificar si es tiempo extra.
    
                $in = TimeCheck::create([
                    'hora' => Carbon::now(),
                    'estatus' => 'Sin horario',
                    'observación' => 'Revisar si es tiempo extra'
                ]);
    
                Check::create([
                    'fecha' => Carbon::now(),
                    'in_id' => $in->id,
                    'out_id' => null,
                    'user_id' => $this->user->id,
                    'company_id' => $company,
                    'schedule_id' => null //Este dia no se encuentra en su horario
                ]);
            }
        }

        session()->flash('message', 'Checado satisfactoriamente.');

        return redirect(route('home'));
    }

    public function render()
    {
        return view('livewire.check.check-create');
    }
}
