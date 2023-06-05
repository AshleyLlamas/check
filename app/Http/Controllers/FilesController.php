<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\UserDocuments;
use Illuminate\Http\Request;

class FilesController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth');
	}

    public function fotos(Image $image){
        return response()->download(storage_path('app/private/'.$image->url), null, [], null);
    }

    public function document(UserDocuments $userDocuments){
        dd($userDocuments->documento_de_identificación_oficial);
        return response()->download(storage_path('app/private/'.$userDocuments->documento_de_identificación_oficial), null, [], null);
    }
}
