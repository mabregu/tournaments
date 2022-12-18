<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/games",
     *     summary="Get all games",
     *     tags={"Games"},
     *     @OA\Response(
     *         response=200,
     *         description="Success"
     *     )
     * )
     */
    public function index()
    {
        // Return all games
        return Game::latest()->paginate(10);
    }

    /**
     * @OA\Post(
     *     path="/api/games",
     *     summary="Create a new game",
     *     tags={"Games"},
     *     @OA\RequestBody(
     *         required=true
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success"
     *     )
     * )
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
     * @OA\Get(
     *     path="/api/games/{id}",
     *     summary="Get a game",
     *     tags={"Games"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of game to return",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success"
     *     )
     * )
     */
    public function show(Game $id)
    {
        // Return the game
        return $id;
    }

    /**
     * @OA\Put(
     *     path="/api/games/{id}",
     *     summary="Update a game",
     *     tags={"Games"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of game to update",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success"
     *     )
     * )
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
     * @OA\Delete(
     *     path="/api/games/{id}",
     *     summary="Delete a game",
     *     tags={"Games"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of game to delete",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success"
     *     )
     * )
     */
    public function destroy(Game $game)
    {
        // Delete the game
        $game->delete();

        return response()->noContent();
    }
}
