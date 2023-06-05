<?php

namespace App\Console\Commands;

use App\Models\Assistance;
use App\Models\Check;
use App\Models\NonWorkingDay;
use App\Models\User;
use App\Models\Vacation;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class MakeAbsence extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:absence';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ejecuta inasistencia en los usuarios';

    protected $clave;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
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

        //GENERAR ESTATUS INACTIVO PARA USUARIOS EN VACACIONES
        if(Vacation::where('estatus', 'Aprobado')->whereDate('fecha_inicial', '>=' , Carbon::now()->formatLocalized('%Y-%m-%d'))->count()){

            $users_activos_a_inactivos = User::where('estatus', 'Activo')->whereHas('vacations', function($query) {
                $query->where('estatus', 'Aprobado')->whereDate('fecha_inicial', '>=' , Carbon::now()->formatLocalized('%Y-%m-%d'));
            })->get();

            foreach($users_activos_a_inactivos as $user){
                $user->estatus = 'Inactivo';
                $user->save();
            }
        }

        //GENERAR ESTATUS ACTIVO PARA USUARIOS QUE ESTABAN EN VACACIONES
        if(Vacation::where('estatus', 'Aprobado')->whereDate('fecha_final', '<=' , Carbon::now()->formatLocalized('%Y-%m-%d'))->count()){

            $users_inativos_a_activos = User::where('estatus', 'Inactivo')->whereHas('vacations', function($query) {
                $query->where('estatus', 'Aprobado')->whereDate('fecha_final', '<=' , Carbon::now()->formatLocalized('%Y-%m-%d'));
            })->get();

            foreach($users_inativos_a_activos as $user){
                $user->estatus = 'Activo';
                $user->save();
            }
        }

        //VER SI EL DIA DE HOY SE TRABAJA
        if(!NonWorkingDay::where('fecha', '=', Carbon::now()->format('Y-m-d'))->first()){
            //SE TRABAJA

            //GENERAR INASISTENCIAS
            $users = User::where('estatus', 'Activo')->whereHas('schedules', function($query) use ($clave) {
                $query->where('día', '=', $clave)->where('actual', true);
            })->get();

            foreach($users as $user){
                $existe_un_check = Check::where('user_id', $user->id)->whereNotNull('out_id')->where('fecha', Carbon::now()->formatLocalized('%Y-%m-%d'))->get()->last();

                if(!$existe_un_check){
                    Assistance::create([
                        'user_id' => $user->id,
                        'asistencia' => 'No asistió',
                        'observación' => 'Sin especificar'
                    ]);
                }
            }
        }

        $texto = "[".date("Y-m-d H:i:s")."] - Hola, estoy funcionado 2";
        Storage::append("archivo.text", $texto);
    }
}
