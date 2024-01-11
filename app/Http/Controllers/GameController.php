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


        

        return response()->json(['message' => 'Partie créée', 'gameCode' => $game], 201);
    }
    
}