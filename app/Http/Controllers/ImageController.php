<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Http\Requests\StoreImageRequest;
use App\Http\Requests\UpdateImageRequest;

class ImageController extends Controller
{
    public function show($user_id, $slug)
    {
        $storagePath = storage_path('app/images/users/' . $user_id . '/' . $slug);
        return Image::make($storagePath)->response();
    }
}
