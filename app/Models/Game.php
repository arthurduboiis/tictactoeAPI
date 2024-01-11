<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $table = 'game';
    protected $primaryKey = 'gameID';
    public $timestamps = false;

    protected $fillable = [
        'userID_joueur_1',
        'userID_joueur_2',
        'state',
        'gameCode',
    ];

    public function joueur1()
    {
        return $this->belongsTo(User::class, 'userID_joueur_1');
    }

    public function joueur2()
    {
        return $this->belongsTo(User::class, 'userID_joueur_2');
    }

}
