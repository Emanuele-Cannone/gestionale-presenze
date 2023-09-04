<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ComunicationController;
use App\Http\Controllers\Progen\ProgenCustomerController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\RosterController;
use App\Models\Question;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })
    ->name('dashboard');

    Route::resource('attendances', AttendanceController::class);

    // Roster routes
    Route::resource('rosters', RosterController::class);
    Route::post('downloadRosterEmptyFile', [RosterController::class, 'downloadEmptyFile'])->name('downloadRosterEmptyExcel');
    Route::post('importRosterFile', [RosterController::class, 'importRosterFile'])->name('importRosterFile');


    Route::resource('comunications', ComunicationController::class);

    // Progen routes
    Route::resource('progen', ProgenCustomerController::class);
    Route::put('updateCustomerUsers/{id}', [ProgenCustomerController::class, 'updateCustomerUsers'])->name('progen.updateCustomerUsers');

    // Question routes
    Route::resource('questions', QuestionController::class);

});
