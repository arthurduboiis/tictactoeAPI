<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\GameController;
// use App\Http\Controllers\MorpionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/add-friend', [FriendController::class, 'addFriend']);
    Route::post('/accept-friend', [FriendController::class, 'acceptFriend']);
    Route::post('/reject-friend', [FriendController::class, 'rejectFriend']);
    Route::get('/pending-friend', [FriendController::class, 'pendingFriend']);
    Route::get('/get-friend', [FriendController::class, 'getFriends']);

    Route::post('/create-game', [GameController::class, 'createGame']);
    Route::post('/join-game', [GameController::class, 'joinGame']);
    // Route::post('/update-results', [MorpionController::class, 'updateResults']);
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/register', [RegisterController::class, 'register']);
