<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlayerController extends Controller
{
    /**
     * Get details of a particular player
     */
    public function show(Game $game, User $user)
    {
        if (!$game && $user) abort(404);
        if (!in_array($user->id, [$game->player_one_id, $game->player_two_id])) abort(403);
        else return [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
        ];
    }

    /**
     * Get players associated with a particular game
     */
    public function getGamePlayers(Game $game)
    {
        $user = Auth::user();
        if (!$game && $user) abort(404);
        if (!in_array($user->id, [$game->player_one_id, $game->player_two_id])) abort(403);
        else {
            $p1User = User::find($game->player_one_id);
            $p2User = User::find($game->player_two_id);
            $p1 = [
                'id' => $p1User['id'],
                'name' => $p1User['name'],
                'email' => $p1User['email'],
            ];
            $p2 = $p2User ? [
                'id' => $p2User['id'],
                'name' => $p2User['name'],
                'email' => $p2User['email'],
            ] : null;
            return [$p1, $p2];
        }
    }
}
