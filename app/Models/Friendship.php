<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friendship extends Model
{
    use HasFactory;

    protected $fillable = ['userID', 'friend_id', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'userID');
    }

    public function friend()
    {
        return $this->belongsTo(User::class, 'friend_id', 'userID');
    }
}
