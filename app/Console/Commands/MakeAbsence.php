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

        switch(substr(Carbon::now()->formatLocalized('%A'), 0, 2)){
            case "lu":
                $this->clave = "Lunes";
            break;
            case "ma":
                $this->clave = "Martes";
            break;
            case "mi":
                $this->clave = "Miércoles";
            break;
            case "ju":
                $this->clave = "Jueves";
            break;
            case "vi":
                $this->clave = "Viernes";
            break;
            case "sá":
                $this->clave = "Sábado";
            break;
            case "do":
                $this->clave = "Domingo";
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
            $users = User::where('estatus', 'Activo')->whereHas('schedules', function($query) {
                $query->where('día', '=', $this->clave)->where('actual', true);
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

        //$texto = "[".date("Y-m-d H:i:s")."] - Hola, estoy funcionado";
        //Storage::append("archivo.text", $texto);
    }
}
