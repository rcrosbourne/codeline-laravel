<?php

use App\Http\Controllers\WeekendTrackerController;
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

Route::get('/', [WeekendTrackerController::class,'index'])->name('weekend-tracker.create');
Route::post('/', [WeekendTrackerController::class,'store'])->name('weekend-tracker.store');

