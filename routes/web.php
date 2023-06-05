<?php

use App\Http\Controllers\Device\DeviceAuthController;
use App\Http\Controllers\FilesController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('home')->name('home');
// });


Route::view('/profile', 'auth.profile')->middleware('auth')->name('profile');

Route::view('/check', 'check')->middleware('auth')->name('ckeck');

Auth::routes(["register" => false]);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/', [App\Http\Controllers\HomeController::class, 'create'])->name('info.create');


Route::group(['prefix' => 'device', 'namespace' => 'Device'], function () {
    Route::get('/login', [DeviceAuthController::class, 'getLogin'])->name('deviceLogin');
    Route::post('/login', [DeviceAuthController::class, 'postLogin'])->name('deviceLoginPost');

    Route::group(['middleware' => 'deviceauth'], function () {
        Route::get('/', function () {
            return view('device.check');
        })->name('deviceCheck');

    });
});

//ARCHIVOS
Route::get('storage/private/{image}', [FilesController::class, 'fotos'])->name('images');

//USER DOCUMENTS (REFACTORIZAR COMO EL DE ARRIBA *****)
Route::get('storage/private/{userDocuments}', [FileController::class, 'documents'])->name('documents');