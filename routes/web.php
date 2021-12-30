<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;



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
})->middleware(['auth'])->name('main');

// Route::get('/{any?}', function () {
//     return view('main', ['rooms' => Room::all()]);
// })->middleware(['auth']);


Route::get('/room/index', [RoomController::class, 'index'])->name('room.index');
Route::post('/room/store', [RoomController::class, 'store'])->name('room.store');
Route::get('/room/{id}', [RoomController::class, 'show'])->name('room.show');
Route::post('/room/{id}', [RoomController::class, 'setUserInRoom'])->name('room.setUserInRoom');
Route::get('/room/{id}/score', [RoomController::class, 'getScore'])->name('room.getScore');
Route::get('/room/{id}/list', [RoomController::class, 'getPlayerList'])->name('room.getPlayerList');
Route::get('/room/leave', [RoomController::class, 'leaveRoom'])->name('room.leaveRoom');

// in Game
Route::get('/getRandomWord', [RoomController::class, 'getRandomWord'])->name('room.getRandomWord');
Route::post('/confirmWords/{lastWord}/{submitWord}', [RoomController::class, 'confirmWords'])->name('room.confirmWord');
Route::post('/room/{id}/gameStart', [RoomController::class, 'gameStart'])->name('room.gameStart');
Route::get('/getProfile/{id}', [RoomController::class, 'getProfile'])->name('room.getProfile');
Route::get('/setRound/{id}', [RoomController::class, 'setRound'])->name('room.setRound');

Route::get('/user', [UserController::class, 'profile']);

Route::get('/home', [HomeController::class, 'index']);

Route::resource('/posts', PostController::class);

require __DIR__ . '/auth.php';
