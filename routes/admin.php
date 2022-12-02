<?php

//Home

use App\Http\Controllers\Admin\CheckController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AssistanceController;
use Illuminate\Support\Facades\Route;

Route::get('', [HomeController::class, 'index'])->name('admin.index');

//Users
Route::resource('users', UserController::class)->only(['index', 'create', 'edit', 'show', 'destroy'])->names('admin.users');

//Checks
Route::resource('checks', CheckController::class)->only(['index', 'show'])->names('admin.checks');

//Assistances
Route::get('/assistances/{assistance}', [AssistanceController::class, 'show'])->name('admin.assistances.show');