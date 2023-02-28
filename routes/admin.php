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
use App\Http\Controllers\Admin\AdmonitionTypeController;
use App\Http\Controllers\Admin\ElectronicController;
use App\Http\Controllers\Admin\ExtraHourController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\Admin\NonWorkingDayController;
use App\Http\Controllers\Admin\PrinterController;
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

//Inventories
Route::resource('inventories', InventoryController::class)->only(['index', 'create', 'edit', 'show', 'destroy'])->names('admin.inventories');

//Electronic
Route::resource('electronics', ElectronicController::class)->only(['index', 'create', 'edit', 'show', 'destroy'])->names('admin.electronics');

//Printers
Route::resource('printers', PrinterController::class)->only(['index', 'create', 'edit', 'show', 'destroy'])->names('admin.printers');

//Horas extras
Route::resource('extra-hours', ExtraHourController::class)->only(['index', 'create', 'edit', 'show', 'destroy'])->names('admin.extra_hours');

//Admonitions
Route::resource('admonitions', AdmonitionController::class)->only(['index', 'show'])->names('admin.admonitions');
    //PDFS
    Route::get('/admonitions/pdfs/{admonition}', [AdmonitionController::class, 'pdf'])->middleware('auth', 'can:admin.admonitions.pdfs')->name('pdfs.admonitions.view');

//Admonition types
Route::resource('admonition-types', AdmonitionTypeController::class)->only(['index', 'create', 'edit', 'show', 'destroy'])->names('admin.admonition_types');

//Calendar
Route::get('/calendars', [NonWorkingDayController::class, 'index'])->name('admin.calendars.index');
Route::get('/calendars/create', [NonWorkingDayController::class, 'create'])->name('admin.calendars.create');
Route::get('/calendars/edit/{non_working_day}', [NonWorkingDayController::class, 'edit'])->name('admin.calendars.edit');
Route::delete('/calendars/{non_working_day}', [NonWorkingDayController::class, 'destroy'])->name('admin.calendars.destroy');

//Administrative records
Route::resource('administrative-records', AdministrativeRecordController::class)->only(['index', 'create', 'edit', 'show', 'destroy'])->names('admin.administrative_records');

    //PDFS
    Route::get('/administrative-records/pdfs/{administrative_record}', [AdministrativeRecordController::class, 'pdf'])->middleware('auth', 'can:admin.administrative_records.pdfs')->name('pdfs.administrative_records.view');

//Cost centers
Route::resource('cost-centers', CostCenterController::class)->only(['index', 'create', 'edit', 'show', 'destroy'])->names('admin.cost_centers');

//Roles
Route::resource('roles', RoleController::class)->only(['index', 'create', 'edit', 'show', 'destroy'])->names('admin.roles');
