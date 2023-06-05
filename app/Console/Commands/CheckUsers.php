<?php

namespace App\Console\Commands;

use App\Models\ExtraHour;
use App\Models\NonWorkingDay;
use App\Models\Check;
use App\Models\Assistance;
use App\Models\Attendance;
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
    }

    public function handle()
    {
        $texto = "[".date("Y-m-d H:i:s")."] - Hola, estoy funcionado";
        Storage::append("archivo.text", $texto);

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

        foreach(Attendance::whereDate('timestamp', Carbon::now())->get() as $i => $check){

            //Buscar usuario
            $user = User::where('número_de_empleado', $check->id)->get()->first();

            if(isset($user)){
                //Si existe

                //Fecha a comparar del dia de hoy en caso de tener horario

                // $fecha_a_comparar = $user->schedules->where('actual', true)->where('día', $clave)->last(); Otra manera de obtener la info

                $fecha_a_comparar = Schedule::where('scheduleble_id', $user->id)->where('scheduleble_type', 'App\Models\User')->where('actual', true)->where('día', $clave)->get()->last(); //Funciono asi asi que no le movi aunque me hubiese gustado tomar la opcion de arriba

                //Ver si tiene ya tiene asistencia
                if(Assistance::where('user_id', $user->id)->whereDate('created_at', Carbon::now())->count()){
                    //Aqui se evaluaria cual tiene el check mas temprano para tomarlo como resultado final

                    
                }else{
                    //Ver si ya tiene por lo menos un check
                    if(Check::where('user_id', $user->id)->where('fecha', Carbon::now())->count() >= 2){
                        //Generar el ultimo check

                        
                        $lastCheck = Attendance::where('id', $user->número_de_empleado)->whereDate('timestamp',Carbon::now())->latest()->first(); //Tomar el ultimo check por que ya hay de entrada

                        if($fecha_a_comparar){
                            if($fecha_a_comparar->hora_de_entrada->modify('+15 minute')->toDateTimeString() <= $lastCheck->timestamp){
                                $out_estatus = 'Salió antes';
                                $out_observación = 'Sin observación';
                            }else{
                                $out_estatus = 'Salió despues';
                                $out_observación = $fecha_a_comparar->hora_de_entrada->diff($lastCheck->timestamp)->format('por %h horas %i minutos con %s segundos');
                            }
                        }else{
                            //Sin horario
                            $out_estatus = 'Sin horario';
                            $out_observación = 'Revisar si es tiempo extra';
                        }

                        $out = TimeCheck::create([
                            'hora' => substr($lastCheck->timestamp, -8),
                            'estatus' => $out_estatus,
                            'observación' => $out_observación,
                            'created_at' => Carbon::now()
                        ]);

                        $check = $user->checks->where('fecha', Carbon::now())->first();

                        $check->out_id = $out->id;
                        $check->save();

                        $tiempo = $check->in->created_at->diff($lastCheck->timestamp, -8)->format('%h horas %i minutos con %s segundos');

                        $assistance = Assistance::create([
                            'check_id' => $check->id,
                            'user_id' => $user->id,
                            'asistencia' => 'Asistió',
                            'observación' => 'Trabajo: '.$tiempo. 'desde el primer check',
                            'created_at' => Carbon::now()
                        ]);

                    }else{
                        //No tiene, pasar a generarse
                        if($check->where('id', $user->número_de_empleado)->count() >= 2){

                            //if($user->checks->where('fecha', Carbon::now())->count() == 0){
                                //El usuario tiene checada de entrada y salida
                                $firstCheck = Attendance::where('id', $user->número_de_empleado)->whereDate('timestamp',Carbon::now())->first();
                                $lastCheck = Attendance::where('id', $user->número_de_empleado)->whereDate('timestamp',Carbon::now())->latest()->first();

                                if($fecha_a_comparar){
                                    //Tiene horario
                                    if($fecha_a_comparar->hora_de_entrada->modify('+15 minute')->toDateTimeString() <= $firstCheck->timestamp){
                                        $in_estatus = 'Llego a tiempo';
                                        $in_observación = 'Sin observación';
                                    }else{
                                        $in_estatus = 'Llego tarde';
                                        $in_observación = $fecha_a_comparar->hora_de_entrada->diff($firstCheck->timestamp)->format('por %h horas %i minutos con %s segundos');
                                    }

                                    if($fecha_a_comparar->hora_de_entrada->modify('+15 minute')->toDateTimeString() <= $lastCheck->timestamp){
                                        $out_estatus = 'Salió antes';
                                        $out_observación = 'Sin observación';
                                    }else{
                                        $out_estatus = 'Salió despues';
                                        $out_observación = $fecha_a_comparar->hora_de_entrada->diff($lastCheck->timestamp)->format('por %h horas %i minutos con %s segundos');
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
                                    'hora' => substr($firstCheck->timestamp, -8),
                                    'estatus' => $in_estatus,
                                    'observación' => $in_observación,
                                    'created_at' => Carbon::now()
                                ]);

                                if($firstCheck->timestamp->modify('+4 hour')->toDateTimeString() < $lastCheck->timestamp){
                                    $out = TimeCheck::create([
                                        'hora' => substr($lastCheck->timestamp, -8),
                                        'estatus' => $out_estatus,
                                        'observación' => $out_observación,
                                        'created_at' => Carbon::now(),
                                    ]);

                                    $outId = $out->id;
                                }else{
                                    $outId = null;
                                }
                
                                //*Checvk
                                $finalCheck = Check::create([
                                    'fecha' =>Carbon::now(),
                                    'in_id' => $in->id, //Primer check
                                    'out_id' => $outId,
                                    'user_id' => $user->id,
                                    'company_id' => $user->company_id,
                                    'created_at' => Carbon::now()
                                    // 'schedule_id'
                                ]);

                                if($firstCheck->timestamp->modify('+4 hour')->toDateTimeString() < $lastCheck->timestamp){

                                    $assistance = Assistance::create([
                                        'check_id' => $finalCheck->id,
                                        'user_id' => $user->id,
                                        'asistencia' => 'Asistió',
                                        'observación' => 'Asistencia completa',
                                        'created_at' => Carbon::now()
                                    ]);
                                }
                            //}
                            //sdsds
                        }else{
                            //El usuario solo tiene entrada
            
                            if($fecha_a_comparar){
                                if($fecha_a_comparar->hora_de_entrada->modify('+15 minute')->toDateTimeString() <= $check->timestamp){
                                    $in_estatus = 'Llego a tiempo';
                                    $in_observación = 'Sin observación';
                                }else{
                                    $in_estatus = 'Llego tarde';
                                    $in_observación = $fecha_a_comparar->hora_de_entrada->diff($check->timestamp)->format('por %h horas %i minutos con %s segundos');
                                }
                            }else{
                                $in_estatus = 'Sin horario';
                                $in_observación = 'Revisar si es tiempo extra';
                            }

                            //Primer TimeCheck
                            $in = TimeCheck::create([
                                'hora' => substr($check->timestamp, -8),
                                'estatus' =>$in_estatus,
                                'observación' => $in_observación,
                                'created_at' => Carbon::now()
                            ]);
            
                            //*Checvk
                            $finalCheck = Check::create([
                                'fecha' =>Carbon::now(),
                                'in_id' => $in->id, //Primer check
                                'user_id' => $user->id,
                                'company_id' => $user->company_id,
                                'created_at' => Carbon::now()
                                // 'schedule_id'
                            ]);
                        }
                    }
                }
            }
        }
    }
}