<?php

use Illuminate\Support\Facades\Broadcast;
use App\Http\Controllers\GameController;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('tictactoe.{gameCode}', function ($user, $gameCode) {
    // Call the GameController to perform authorization logic
    $controller = app(GameController::class);
    
    // You can define a method in GameController for the authorization logic
    return $controller->authorizeChannel($user, $gameCode);
});
