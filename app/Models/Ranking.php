<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ranking extends Model
{
    protected $table = 'ranking';
    protected $fillable = ['userID', 'win', 'lose', 'equal', 'score', 'last_updated'];
    protected $dates = ['last_updated'];
    protected $primaryKey = 'userID';
    public $timestamps = false;
}
