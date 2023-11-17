<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Friendship;

class FriendController extends Controller
{
    public function addFriend(Request $request)
    {
        $user = auth()->user();

        $friendUsername = $request->input('username');
        $friend = User::where('username', $friendUsername)->first();
        if (!$friend) {
            return response()->json(['message' => 'Utilisateur introuvable'], 404);
        }

        $friendshipExists = Friendship::where('userID', $user->userID)
            ->where('friend_id', $friend->userID)
            ->first();

        if ($friendshipExists) {
            return response()->json(['message' => 'Vous êtes déjà ami avec cet utilisateur'], 400);
        }

        $friendship = new Friendship([
            'userID' => $user->userID,
            'friend_id' => $friend->userID,
            'status' => 'pending',
        ]);
        $friendship->save();

        return response()->json(['message' => 'Demande d\'ami envoyée avec succès']);
    }

    public function acceptFriend(Request $request)
    {
        $user = auth()->user();

        $friendUsername = $request->input('username');
        $friend = User::where('username', $friendUsername)->first();

        if (!$friend) {
            return response()->json(['message' => 'Utilisateur introuvable'], 404);
        }

        $friendship = Friendship::where('userID', $friend->userID)
            ->where('friend_id', $user->userID)
            ->where('status', 'pending')
            ->first();

        if (!$friendship) {
            return response()->json(['message' => 'Aucune demande d\'ami en attente'], 404);
        }

        $friendship->status = 'accepted';
        $friendship->save();

        return response()->json(['message' => 'Demande d\'ami acceptée']);
    }

    public function rejectFriend(Request $request)
    {
        $user = auth()->user();

        $friendUsername = $request->input('username');
        $friend = User::where('username', $friendUsername)->first();

        if (!$friend) {
            return response()->json(['message' => 'Utilisateur introuvable'], 404);
        }

        $friendship = Friendship::where('userID', $friend->userID)
            ->where('friend_id', $user->userID)
            ->where('status', 'pending')
            ->first();

        if (!$friendship) {
            return response()->json(['message' => 'Aucune demande d\'ami en attente'], 404);
        }

        $friendship->status = 'rejected';
        $friendship->save();

        return response()->json(['message' => 'Demande d\'ami rejetée']);
    }
}
