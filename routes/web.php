<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\RoomController;
use App\Models\Room;

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

//any? = 어떤 경로라도
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard', ['rooms' => Room::all()]);
})->middleware(['auth'])->name('dashboard');


Route::get('/room/index', [RoomController::class, 'index'])->name('room.index');
Route::post('/room/store', [RoomController::class, 'store'])->name('room.store');
Route::get('/room/{id}', [RoomController::class, 'show'])->name('room.show');
Route::get('/room/leave', [RoomController::class, 'leaveRoom'])->name('room.leaveRoom');



require __DIR__.'/auth.php';
