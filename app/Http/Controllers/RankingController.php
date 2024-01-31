<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ranking;

class RankingController extends Controller
{
    public function index()
    {
        $users = User::all()->sortByDesc('calculateScore');

        return response()->json(['ranking' => $users], 200);
    }

    public function getTopPlayers()
    {
        $topPlayers = Ranking::select('ranking.*', 'users.username')
            ->join('users', 'ranking.userID', '=', 'users.userID')
            ->orderByDesc('score')
            ->take(10)
            ->get();

        return response()->json(['ranking' => $topPlayers], 200);
    }
}
