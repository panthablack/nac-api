<?php

use App\Models\Game;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('games.{game}', function (User $user, Game $game) {
    if ($user->id === $game->player_one_id) return ['id' => $user->id];
    else if (!!$game->player_two_id && $user->id === $game->player_two_id) return ['id' => $user->id];
    else return false;
});
