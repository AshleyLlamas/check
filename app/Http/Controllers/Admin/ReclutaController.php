<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReclutaController extends Controller
{
    public function __construct(){
        $this->middleware('can:admin.reclutas.index')->only('index');
        $this->middleware('can:admin.reclutas.edit')->only('edit');
        $this->middleware('can:admin.reclutas.create')->only('create');
    }
    
    public function index()
    {
        return view('admin.reclutas.index');
    }

    public function create()
    {
        return view('admin.reclutas.create');
    }

    public function edit(User $reclutum)
    {   

        //Laravel uso por default 'reclutum' como variable por el Route::resource

        return view('admin.reclutas.edit', [
            'user' => $reclutum //mandamos 'reclutum' como 'user'
        ]);
    }

    public function destroy(User $user)
    {
        //Ver tipo para redireccionar
        if($user->tipo){
            $tipo = $user->tipo;
        }

        //Foto
        if($user->image){
            Storage::delete($user->image->url);

            $user->image->delete();
        }

        //Documentos
        if($user->document){

            if($user->document->documento_de_identificación_oficial){
                Storage::delete($user->document->documento_de_identificación_oficial);
            }

            if($user->document->documento_del_comprobante_de_domicilio){
                Storage::delete($user->document->documento_del_comprobante_de_domicilio);
            }

            if($user->document->documento_de_no_antecedentes_penales){
                Storage::delete($user->document->documento_de_no_antecedentes_penales);
            }

            if($user->document->documento_de_la_licencia_de_conducir){
                Storage::delete($user->document->documento_de_la_licencia_de_conducir);
            }

            if($user->document->documento_de_la_cedula_profesional){
                Storage::delete($user->document->documento_de_la_cedula_profesional);
            }

            if($user->document->documento_de_la_carta_de_pasante){
                Storage::delete($user->document->documento_de_la_carta_de_pasante);
            }

            if($user->document->documento_del_curriculum_vitae){
                Storage::delete($user->document->documento_del_curriculum_vitae);
            }

            $user->document->delete();
        }

        $user->delete();

        return redirect()->route('admin.reclutas.index')->with('eliminar', 'ok');
    }
}