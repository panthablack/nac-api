<?php

namespace App\Http\Controllers;

use App\Events\BoardUpdated;
use App\Events\GameCreated;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Game::with('playerOne')->whereNull('player_two_id')
            ->where('player_one_id', '!=', $request->user()->id)->latest()->simplePaginate(10);
    }

    /**
     * Join a game
     */
    public function join(Game $game, Request $request)
    {
        Gate::authorize('join', $game);
        if (!$game->player_two_id) return $game->join($request->user());
        else if ($game->player_two_id == $request->user()->id) return $game;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!$request->user()) abort(401);
        else {
            $game =  Game::create(['player_one_id' => $request->user()->id]);
            if (!!$game) {
                GameCreated::dispatch($game);
                return $game;
            } else abort(500, 'Game creation failed.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Game $game)
    {
        if (in_array(Auth::user()->id, [$game->player_one_id, $game->player_two_id])) return $game;
        else abort(403);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Game $game)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Game $game)
    {
        // basic validation
        $validated = $request->validate([
            'board_state' => ['required', 'array', 'between:9,81'],
            'board_state.*' => ['integer', 'between:1,3']
        ]);

        // further validation

        // e.g., check move isn't illegal, etc.

        // make update
        $game->update($validated);

        // Broadcast update
        broadcast(new BoardUpdated($game))->toOthers();

        // return game
        return $game;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Game $game)
    {
        //
    }
}
