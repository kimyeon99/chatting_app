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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/{any?}', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('main', ['rooms' => Room::all()]);
})->middleware(['auth']);

// Route::get('/{any?}', function () {
//     return view('main', ['rooms' => Room::all()]);
// })->middleware(['auth']);


Route::get('/room/index', [RoomController::class, 'index'])->name('room.index');
Route::post('/room/store', [RoomController::class, 'store'])->name('room.store');
Route::get('/room/{id}', [RoomController::class, 'show'])->name('room.show');
Route::get('/room/leave', [RoomController::class, 'leaveRoom'])->name('room.leaveRoom');

// in Game
Route::get('/getRandomWord', [RoomController::class, 'getRandomWord'])->name('room.getRandomWord');
Route::get('/room/confirmWord', [RoomController::class, 'confirmWord'])->name('room.confirmWord');
Route::post('/room/{id}/gameStart', [RoomController::class, 'gameStart'])->name('room.gameStart');



require __DIR__.'/auth.php';
