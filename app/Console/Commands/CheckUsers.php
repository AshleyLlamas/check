<?php

namespace App\Console\Commands;

use App\Models\ExtraHour;
use App\Models\NonWorkingDay;
use App\Models\Check;
use App\Models\Assistance;
use App\Models\Schedule;
use App\Models\TimeCheck;
use App\Models\User;
use App\Models\Zkteco as ModelsZkteco;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Rats\Zkteco\Lib\ZKTeco;

class CheckUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */

    protected $signature = 'check:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Iniciar la generación de checadas desde todos los dispositivos ZKTeco conectados a la red de Intranet';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    protected $clave;

    public function __construct()
    {
        parent::__construct();

        switch(substr(Carbon::now()->formatLocalized('%A'), -4)){
            case "unes":
                $clave = "Lunes";
            break;
            case "rtes":
                $clave = "Martes";
            break;
            case "oles":
                $clave = "Miércoles";
            break;
            case "eves":
                $clave = "Jueves";
            break;
            case "rnes":
                $clave = "Viernes";
            break;
            case "bado":
                $clave = "Sábado";
            break;
            case "ingo":
                $clave = "Domingo";
            break;
            default:
                dd('ERROR - NO SE IDENTIFICA EL DÍA, HABLE CON EL ADMINISTRADOR');
            break;
        }
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        foreach(ModelsZkteco::where('status', 1)->get() as $i => $zktecos){

            //CONFIGURAR IP DEL ZKTECO
            $zk = new ZKTeco($zktecos->ip, $zktecos->puerto);

            if($zk->connect()){

                $texto = "[".date("Y-m-d H:i:s")."] - Hay conexión ".$zktecos->ip.":".$zktecos->puerto;
                Storage::append("archivo.text", $texto);

                //CONECTAR
                $zk->connect();
                $zk->enableDevice();  

                //FILTRAR LA INFO POR FECHA DE HOY
                $checks = array_filter($zk->getAttendance(), function ($item) { 
                    return substr($item['timestamp'], 0, 10) == Carbon::now()->format('Y-m-d');
                });

                //--------------------------- YA SE LLAMO LOS DATOS DEL CHECADOR -------------------------------//

                foreach($checks as $check){

                    //Buscar usuario
                    $user = User::where('número_de_empleado', $check['id'])->get()->first();

                    if(isset($user)){
                        //Si existe

                        //Fecha a comparar del dia de hoy en caso de tener horario

                        // $fecha_a_comparar = $user->schedules->where('actual', true)->where('día', $clave)->last(); Otra manera de obtener la info

                        $fecha_a_comparar = Schedule::where('scheduleble_id', $user->id)->where('scheduleble_type', 'App\Models\User')->where('actual', true)->where('día', $this->clave)->get()->last(); //Funciono asi asi que no le movi aunque me hubiese gustado tomar la opcion de arriba

                        //Ver si tiene ya tiene asistencia
                        if(Assistance::where('user_id', $user->id)->whereDate('created_at', Carbon::today())->first()){
                            //Aqui se evaluaria cual tiene el check mas temprano para tomarlo como resultado final
                        }else{
                            //Ver si ya tiene por lo menos un check
                            if($user->checks->where('fecha', Carbon::today())->first()){
                                //Generar el ultimo check

                                $lastCheck = collect($checks)->where('id', $check['id'])->last(); //Tomar el ultimo check por que ya hay de entrada

                                if($fecha_a_comparar){
                                    if($fecha_a_comparar->hora_de_entrada->modify('+15 minute')->getTimestamp() <= $lastCheck['timestamp']){
                                        $out_estatus = 'Salió antes';
                                        $out_observación = 'Sin observación';
                                    }else{
                                        $out_estatus = 'Salió despues';
                                        $out_observación = $fecha_a_comparar->hora_de_entrada->diff($lastCheck['timestamp'])->format('por %h horas %i minutos con %s segundos');
                                    }
                                }else{
                                    //Sin horario
                                    $out_estatus = 'Sin horario';
                                    $out_observación = 'Revisar si es tiempo extra';
                                }

                                $out = TimeCheck::create([
                                    'hora' => substr($lastCheck['timestamp'], -8),
                                    'estatus' => $out_estatus,
                                    'observación' => $out_observación
                                ]);

                                $check = $user->checks->where('fecha', Carbon::today())->first();

                                $check->out_id = $out->id;
                                $check->save();

                                $tiempo = $check->in->created_at->diff($lastCheck['timestamp'], -8)->format('%h horas %i minutos con %s segundos');

                                $assistance = Assistance::create([
                                    'check_id' => $check->id,
                                    'user_id' => $user->id,
                                    'asistencia' => 'Asistió',
                                    'observación' => 'Trabajo: '.$tiempo. 'desde el primer check'
                                ]);

                            }else{
                                //No tiene, pasar a generarse
                                if(count(collect($checks)->where('id', $check['id'])) >= 2){

                                    if($user->checks->where('fecha', Carbon::today())->count() == 0){
                                        //El usuario tiene checada de entrada y salida
                                        $firstCheck = collect($checks)->where('id', $check['id'])->first();
                                        $lastCheck = collect($checks)->where('id', $check['id'])->last();

                                        if($fecha_a_comparar){
                                            //Tiene horario
                                            if($fecha_a_comparar->hora_de_entrada->modify('+15 minute')->getTimestamp() <= $firstCheck['timestamp']){
                                                $in_estatus = 'Llego a tiempo';
                                                $in_observación = 'Sin observación';
                                            }else{
                                                $in_estatus = 'Llego tarde';
                                                $in_observación = $fecha_a_comparar->hora_de_entrada->diff($firstCheck['timestamp'])->format('por %h horas %i minutos con %s segundos');
                                            }

                                            if($fecha_a_comparar->hora_de_entrada->modify('+15 minute')->getTimestamp() <= $lastCheck['timestamp']){
                                                $out_estatus = 'Salió antes';
                                                $out_observación = 'Sin observación';
                                            }else{
                                                $out_estatus = 'Salió despues';
                                                $out_observación = $fecha_a_comparar->hora_de_entrada->diff($lastCheck['timestamp'])->format('por %h horas %i minutos con %s segundos');
                                            }

                                        }else{
                                            //Sin horario
                                            $in_estatus = 'Sin horario';
                                            $in_observación = 'Revisar si es tiempo extra';

                                            $out_estatus = 'Sin horario';
                                            $out_observación = 'Revisar si es tiempo extra';
                                        }
                                        
                                        //Primer TimeCheck
                                        $in = TimeCheck::create([
                                            'hora' => substr($firstCheck['timestamp'], -8),
                                            'estatus' => $in_estatus,
                                            'observación' => $in_observación
                                        ]);
                        
                                        $out = TimeCheck::create([
                                            'hora' => substr($lastCheck['timestamp'], -8),
                                            'estatus' => $out_estatus,
                                            'observación' => $out_observación
                                        ]);
                        
                                        //*Checvk
                                        $finalCheck = Check::create([
                                            'fecha' => substr($check['timestamp'], 0, 10),
                                            'in_id' => $in->id, //Primer check
                                            'out_id' => $out->id,
                                            'user_id' => $user->id,
                                            'company_id' => $user->company_id,
                                            // 'schedule_id'
                                        ]);
                        
                                        $assistance = Assistance::create([
                                            'check_id' => $finalCheck->id,
                                            'user_id' => $user->id,
                                            'asistencia' => 'Asistió',
                                            'observación' => 'Asistencia completa'
                                        ]);
                                    }
                                }else{
                                    //El usuario solo tiene entrada
                    
                                    if($fecha_a_comparar){
                                        if($fecha_a_comparar->hora_de_entrada->modify('+15 minute')->getTimestamp() <= $check['timestamp']){
                                            $in_estatus = 'Llego a tiempo';
                                            $in_observación = 'Sin observación';
                                        }else{
                                            $in_estatus = 'Llego tarde';
                                            $in_observación = $fecha_a_comparar->hora_de_entrada->diff($check['timestamp'])->format('por %h horas %i minutos con %s segundos');
                                        }
                                    }else{
                                        $in_estatus = 'Sin horario';
                                        $in_observación = 'Revisar si es tiempo extra';
                                    }

                                    //Primer TimeCheck
                                    $in = TimeCheck::create([
                                        'hora' => substr($check['timestamp'], -8),
                                        'estatus' =>$in_estatus,
                                        'observación' => $in_observación
                                    ]);
                    
                                    //*Checvk
                                    $finalCheck = Check::create([
                                        'fecha' => substr($check['timestamp'], 0, 10),
                                        'in_id' => $in->id, //Primer check
                                        'user_id' => $user->id,
                                        'company_id' => $user->company_id,
                                        // 'schedule_id'
                                    ]);
                                }
                            }
                        }
                    }
                }
            }else{
                //No conecto
                $texto = "[".date("Y-m-d H:i:s")."] - No hay conexión";
                Storage::append("archivo.text", $texto);
            }
        }
    }
}
