<?php
namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use App\Services\GameService;

class GameController extends Controller {

    // init service


    public function __construct(public GameService $gameService) {
        
    }

    public function createGame(Request $request) {

        $game = $this->gameService->createGame($request);


        

        return response()->json(['message' => 'Partie créée', 'gameCode' => $game->gameCode], 201);
    }

    public function joinGame(Request $request) {
        $game = $this->gameService->joinGame($request);

        return response()->json(['message' => 'Partie rejointe'], 200);
    }

     public function authorizeChannel($user, $gameCode) {
        // Implement your channel authorization logic here
        $game = Game::where('gameCode', $gameCode)->first();

        if (!$game) {
            // Game not found, user is not authorized
            return false;
        }

        // You can implement more sophisticated authorization logic here
        // For example, check if the user is one of the players in the game

        // Return true if the user is authorized
        return true;
    }
    
}