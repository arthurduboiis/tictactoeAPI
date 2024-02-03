<?php

namespace App\Services;

use App\Models\Game;
use Illuminate\Http\Request;
use App\Events\UserJoined;
use App\Events\PartyChannel;
use App\Models\User;

class GameService {
 

    public function createGame(Request $request): Game {
        $gameCode = substr(md5(uniqid()), 0, 6);
        $user = auth()->user();
        $game = Game::create([
            'userID_joueur_1' => $user->id,
            'userID_joueur_2' => null,
            'state' => 'pending user 2',
            'gameCode' => $gameCode,
        ]);

        $game->save();
        
        UserJoined::dispatch($user, $game->gameCode);
        //broadcast(new UserJoined($user, $game->gameCode));
        
        return $game;
    }

    public function joinGame(Request $request): Game {
        $game = Game::where('gameCode', $request->input('gameCode'))->first();
        $user = auth()->user();

        if (!$game) {
            abort(404, 'Partie introuvable');
        }

        $game->userID_joueur_2 = $user->id;
        $game->save();
        broadcast(new UserJoined($user, $game->gameCode));

        return $game;
    }
    
}