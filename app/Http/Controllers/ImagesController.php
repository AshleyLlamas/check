<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImagesController extends Controller
{
    public function show($slug){

        dd(6);
        $image = Image::get('images/' . $slug . '.jpg');

        return response()->make($image, 200, ['content-type' => 'image/jpg']);
    }
}
