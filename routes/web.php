<?php

use App\Http\Controllers\ManageUserController;
use App\Http\Controllers\SRController;
use App\Http\Controllers\TableExportController;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    });

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    ############################ Manage User Routes ###############################
    Route::get('manageuser/list', [ManageUserController::class, 'list'])->name('manageuser.list');
    Route::get('manageuser/add', [ManageUserController::class, 'add'])->name('manageuser.add');
    Route::post('manageuser/postadd', [ManageUserController::class, 'postadd'])->name('manageuser.postadd');
    Route::get('manageuser/edit', [ManageUserController::class, 'editUser'])->name('manageuser.edit');
    Route::post('manageuser/update', [ManageUserController::class, 'update'])->name('manageuser.update');
    Route::get('manageuser/delete', [ManageUserController::class, 'delete'])->name('manageuser.delete');
    Route::get('changepassword', [ManageUserController::class, 'changepassword'])->name('changepassword');
    Route::post('updatepassword', [ManageUserController::class, 'updatepassword'])->name('updatepassword');

    Route::get('table-export', [TableExportController::class, 'export'])->name('table.export');

    ############################ SR Routes ###############################
    Route::get('excel', [SRController::class, 'index'])->name('excel');
    Route::post('import', [SRController::class, 'import'])->name('import');
    Route::get('report', [SRController::class, 'report'])->name('report');
    Route::post('daterange', [SRController::class, 'daterange'])->name('daterange');
    
});