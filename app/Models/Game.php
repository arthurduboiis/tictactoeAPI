<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $table = 'game';
    protected $fillable = ['userID_joueur_1', 'userID_joueur_2', 'win', 'loose', 'equal', 'state', 'updated_at'];
    public $timestamps = false;
    public function calculateScore()
    {
        $wins = $this->winner()->count() * 3;
        $losses = $this->loser()->count() * 0; 
        $draws = $this->player1()->where('equal', true)->orWhere('player2.equal', true)->count();
        $score = $wins + $losses + $draws;

        return $score;
    }

    public function winner()
    {
        return $this->belongsTo(User::class, 'win', 'userID');
    }

    public function loser()
    {
        return $this->belongsTo(User::class, 'loose', 'userID');
    }

    public function player1()
    {
        return $this->belongsTo(User::class, 'userID_joueur_1', 'userID');
    }

    public function player2()
    {
        return $this->belongsTo(User::class, 'userID_joueur_2', 'userID');
    }
}
