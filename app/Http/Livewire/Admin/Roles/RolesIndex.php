<?php

namespace App\Http\Livewire\Admin\Roles;

use App\Models\Check;
use App\Models\Assistance;
use App\Models\Attendance;
use App\Models\Document;
use App\Models\NonWorkingDay;
use App\Models\Schedule;
use App\Models\TimeCheck;
use App\Models\User;
use App\Models\UserDocuments;
use App\Models\Vacation;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;
use Rats\Zkteco\Lib\ZKTeco;
use Spatie\Permission\Models\Role;
use App\Models\Zkteco as ModelsZkteco;
use Carbon\Carbon;

class RolesIndex extends Component
{
    use WithPagination;

    public $search;

    protected $paginationTheme = "bootstrap";

    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {  

        //remplaza todos los Carbon::now() por Carbon::parse('2023-05-30') y cambia la fecha que buscas



        // $i = 549;

        // foreach(UserDocuments::where('documento_de_identificación_oficial', "!=", null)->get() as $doc){

        //     $doc = Document::create([
        //         'documento' => 'Identificación oficial',
        //         'user_id' => $doc->user->id
        //     ]);

        //     $class = Document::class;

        //     $texto = "($i, $doc->documento_de_identificación_oficial, $doc->id, $class, $doc->created_at, $doc->updated_at, $doc->deleted_at),";
        //     Storage::append("images.text", $texto);

        //     $i ++;
        //     //(1, 'fotos/GfG9XitYHL85n7AA1Rav1zHxYyUVKFFc9nyvzYyn.jpg', 55, 'App\\Models\\User', '2022-12-23 00:54:39', '2023-02-24 00:35:56', NULL),
        // }

        $roles = Role::where('name', 'LIKE' , '%' . $this->search . '%')
                        ->paginate(10);

        $roles_all = Role::count();

        return view('livewire.admin.roles.roles-index', [
            'roles' => $roles,
            'roles_all' => $roles_all
        ]);
    }
}
