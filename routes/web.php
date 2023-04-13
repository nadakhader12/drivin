<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\factcontroller;
use App\Http\Controllers\admin\teamcontroller;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\coursecontroller;
use App\Http\Controllers\admin\appointmentcontroller;

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

Route::prefix('admin')->name('admin.')->middleware('auth','check_user')->group( function() {
    route::get('index',[AdminController::class,'index'])->name('index');

    Route::get('facts/trash', [factcontroller::class, 'trash'])->name('facts.trash');
Route::get('facts/{id}/restore', [factcontroller::class, 'restore'])->name('facts.restore');
Route::delete('facts/{id}/forcedelete', [factcontroller::class, 'forcedelete'])->name('facts.forcedelete');
Route::resource('facts', factcontroller::class);

Route::get('courses/trash', [coursecontroller::class, 'trash'])->name('courses.trash');
Route::get('courses/{id}/restore', [coursecontroller::class, 'restore'])->name('courses.restore');
Route::delete('courses/{id}/forcedelete', [coursecontroller::class, 'forcedelete'])->name('courses.forcedelete');
Route::resource('courses', coursecontroller::class);

Route::get('appointments/trash', [appointmentcontroller::class, 'trash'])->name('appointments.trash');
Route::get('appointments/{id}/restore', [appointmentcontroller::class, 'restore'])->name('appointments.restore');
Route::delete('appointments/{id}/forcedelete', [appointmentcontroller::class, 'forcedelete'])->name('appointments.forcedelete');
Route::resource('appointments', appointmentcontroller::class);

Route::get('teams/trash', [teamcontroller::class, 'trash'])->name('teams.trash');
Route::get('teams/{id}/restore', [teamcontroller::class, 'restore'])->name('teams.restore');
Route::delete('teams/{id}/forcedelete', [teamcontroller::class, 'forcedelete'])->name('teams.forcedelete');
Route::resource('teams', teamcontroller::class);
});
Route::view('not-allowed', 'not_allowed');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
