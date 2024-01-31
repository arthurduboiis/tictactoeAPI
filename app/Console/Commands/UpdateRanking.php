<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Game;
use App\Models\Ranking;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class UpdateRanking extends Command
{
    protected $signature = 'ranking:update';
    protected $description = 'Mettre à jour le classement';

    public function handle()
    {
        $lastUpdate = Ranking::max('last_updated');

        $games = Game::where(function($query) use ($lastUpdate) {
                $query->where('state', 'finish');
            })
            ->get();

        foreach ($games as $game) {
            $winnerID = $game->win;

            if ($winnerID) {
                $this->updateRanking($winnerID, 'win');
                $loserID = $game->userID_joueur_1 === $winnerID ? $game->userID_joueur_2 : $game->userID_joueur_1;
                $this->updateRanking($loserID, 'lose');
            } elseif ($game->equal) {
                $this->updateRanking($game->userID_joueur_1, 'equal');
                $this->updateRanking($game->userID_joueur_2, 'equal');
            }

            Game::where('gameID', $game->gameID)->update([
                'state' => 'updated',
            ]);
        }

        Ranking::query()->update(['last_updated' => now()]);
        Log::info('Le classement a été mis à jour avec succès.');
        $this->info('Le classement a été mis à jour avec succès.');
    }

    private function updateRanking($userID, $type)
    {
        $ranking = Ranking::firstOrNew(['userID' => $userID]);
        $ranking->{$type} += 1;
        $ranking->score = $ranking->win * 3 + $ranking->equal;
        $ranking->last_updated = now();
        $ranking->save();
    }
}
