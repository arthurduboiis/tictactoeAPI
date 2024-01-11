<?php

namespace App\Services;

use App\Models\Game;
use Illuminate\Http\Request;

class GameService {
 

    public function createGame(Request $request): Game {
        $gameCode = '123456';

        $game = Game::create([
            'userID_joueur_1' => $request->input('userID_joueur_1'),
            'userID_joueur_2' => $request->input('userID_joueur_2'),
            'state' => $request->input('state'),
        ]);

        $game->save();
        

        return $game;
    }
    
}