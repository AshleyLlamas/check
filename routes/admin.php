<?php

//Home

use App\Http\Controllers\Admin\AdministrativeRecordController;
use App\Http\Controllers\Admin\AdmonitionController;
use App\Http\Controllers\Admin\AreaController;
use App\Http\Controllers\Admin\CheckController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AssistanceController;
use App\Http\Controllers\Admin\CostCenterController;
use App\Http\Controllers\Admin\ReclutaController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\VacationController;
use App\Models\CostCenter;
use Illuminate\Support\Facades\Route;

Route::get('', [HomeController::class, 'index'])->name('admin.index');

//Areas
Route::resource('areas', AreaController::class)->only(['index', 'create', 'edit', 'show', 'destroy'])->names('admin.areas');

//Users
Route::resource('users', UserController::class)->only(['index', 'create', 'edit', 'show', 'destroy'])->names('admin.users');

//Reclutas
Route::resource('recluta', ReclutaController::class, ['parameters'=> ['{user}' => 'user']])->only(['index', 'create', 'edit', 'show', 'destroy'])->names('admin.reclutas');

//Checks
Route::resource('checks', CheckController::class)->only(['index', 'show'])->names('admin.checks');

//Schedules
Route::resource('schedules', ScheduleController::class)->only(['destroy', 'edit'])->names('admin.schedules');

//Assistances
Route::resource('assistances', AssistanceController::class)->only(['index', 'show'])->names('admin.assistances');

//Vacaciones
Route::resource('vacations', VacationController::class)->only(['index', 'create', 'show'])->names('admin.vacations');

//Admonitions
Route::resource('admonitions', AdmonitionController::class)->only(['index', 'create', 'edit', 'show', 'destroy'])->names('admin.admonitions');

//Administrative records
Route::resource('administrative-records', AdministrativeRecordController::class)->only(['index', 'create', 'edit', 'show', 'destroy'])->names('admin.administrative_records');

//Cost centers
Route::resource('cost-centers', CostCenterController::class)->only(['index', 'create', 'edit', 'show', 'destroy'])->names('admin.cost_centers');

//Roles
Route::resource('roles', RoleController::class)->only(['index', 'create', 'edit', 'show', 'destroy'])->names('admin.roles');