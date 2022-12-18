<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Return all games
        return Game::latest()->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'tournament_id' => ['required', 'exists:tournaments,id'],
            'player1_id' => ['required', 'exists:players,id'],
            'player2_id' => ['required', 'exists:players,id']
        ]);

        // Create a new game
        $game = new Game();
        $game->tournament_id = $request->tournament_id;
        $game->player1_id = $request->player1_id;
        $game->player2_id = $request->player2_id;
        $game->save();

        // Return the game
        return $game;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Game  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Game $id)
    {
        // Return the game
        return $id;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Game $game)
    {
        // Validate the request
        $request->validate([
            'tournament_id' => ['required', 'exists:tournaments,id'],
            'player1_id' => ['required', 'exists:players,id'],
            'player2_id' => ['required', 'exists:players,id']
        ]);

        // Update the game
        $game->tournament_id = $request->tournament_id;
        $game->player1_id = $request->player1_id;
        $game->player2_id = $request->player2_id;
        $game->save();

        // Return the game
        return $game;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function destroy(Game $game)
    {
        // Delete the game
        $game->delete();

        return response()->noContent();
    }
}
