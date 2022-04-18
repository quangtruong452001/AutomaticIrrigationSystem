<?php

namespace App\Http\Controllers\Firebase;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Firebase\ScheduleController;
use Kreait\Firebase\Contract\Database;

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

Route::get('schedules', [ScheduleController::class,'index']);
Route::get('schedules/create', [ScheduleController::class,'create']);
Route::post('schedules/create', [ScheduleController::class,'store']);
Route::get('schedules/edit/{id}', [ScheduleController::class,'edit']);
Route::put('schedules/update/{id}', [ScheduleController::class,'update']);
Route::get('schedules/delete/{id}', [ScheduleController::class,'destroy']);
Route::post('IOControl', [IOController::class,'store']);
Route::get('automated', [ScheduleController::class,'showAutomated']);

Route::get('control/pumpOn', [IOController::class,'storePumpOn']);
Route::get('control/pumpOff', [IOController::class,'storePumpOff']);
Route::get('control/ledOn', [IOController::class,'storeLedOn']);
Route::get('control/ledOff', [IOController::class,'storeLedOff']);


Route::get('/', [ScheduleController::class,'home']);
