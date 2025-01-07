<?php

namespace App\Models;

// use App\Events\GameJoined;

use App\Events\GameJoined;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Game extends Model
{
    /** @use HasFactory<\Database\Factories\GameFactory> */
    use HasFactory;

    protected $guarded = [];

    public function casts(): array
    {
        return [
            'board_state' => 'json'
        ];
    }

    public function playerOne(): BelongsTo
    {
        return $this->belongsTo(User::class, 'player_one_id');
    }

    public function playerTwo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'player_two_id');
    }

    public function join($player): Game
    {
        $this->player_two_id = $player->id;
        $this->save();
        try {
            GameJoined::dispatch($this);
        } catch (\Throwable $th) {
            if (env('APP_DEBUG'))
                abort(500, 'Event dispatch failed: ' . json_encode($th->getMessage()));
            else abort(500, 'Join game failed.');
        }
        return $this;
    }
}
