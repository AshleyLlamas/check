<?php

namespace App\Console\Commands;

use App\Models\Assistance;
use App\Models\Check;
use App\Models\Schedule;
use App\Models\User;
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
                $this->clave = "Miercoles";
            break;
            case "ju":
                $this->clave = "Jueves";
            break;
            case "vi":
                $this->clave = "Viernes";
            break;
            case "sa":
                $this->clave = "Sabado";
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
        //$users = User::join('schedules', 'users.id', '=', 'schedules.user_id')->where('día', $this->clave)->where('actual', true)->get();

        $users = User::whereHas('schedules', function($query) {
            $query->where('día', '=', $this->clave)->where('actual', true);
        })->get();

        foreach($users as $user){
            $existe_un_check = Check::where('user_id', $user->id)->where('fecha', Carbon::now()->formatLocalized('%Y-%m-%d'))->get()->last();

            if(!$existe_un_check){
                Assistance::create([
                    'user_id' => $user->id,
                    'asistencia' => 'Inasistencia',
                    'motivo' => 'Sin especificar'
                ]);
            }
        }

        //$texto = "[".date("Y-m-d H:i:s")."] - Hola, estoy funcionado"; 
        //Storage::append("archivo.text", $texto);
    }
}
