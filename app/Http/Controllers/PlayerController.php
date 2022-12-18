<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/players",
     *     summary="Get all players",
     *     tags={"Players"},
     *     @OA\Response(
     *         response=200,
     *         description="Success"
     *     )
     * )
     */
    public function index()
    {
        // Return all players
        return Player::latest()->paginate(10);
    }

    /**
     * @OA\Post(
     *     path="/api/players",
     *     summary="Create a new player",
     *     tags={"Players"},
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
            'name' => ['required', 'unique:players', 'max:255', 'min:3'],
            'ability' => 'required',
            'gender' => 'required'
        ]);

        // Create a new player
        $player = new Player();
        $player->name = $request->name;
        $player->ability = $request->ability;
        $player->gender = $request->gender;
        $player->save();

        // Return the player
        return $player;
    }

    /**
     * @OA\Get(
     *     path="/api/players/{id}",
     *     summary="Get a player",
     *     tags={"Players"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of player to return",
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
    public function show(Player $id)
    {
        // Return the player
        return $id;
    }

    /**
     * @OA\Put(
     *     path="/api/players/{id}",
     *     summary="Update a player",
     *     tags={"Players"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of player to update",
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
    public function update(Request $request, Player $player)
    {
        // Validate the request
        $request->validate([
            'name' => ['required', 'unique:players', 'max:255', 'min:3'],
            'ability' => 'required',
            'gender' => 'required'
        ]);

        // Update the player
        $player->name = $request->name;
        $player->ability = $request->ability;
        $player->gender = $request->gender;
        $player->save();

        // Return the player
        return $player;
    }

    /**
     * @OA\Delete(
     *     path="/api/players/{id}",
     *     summary="Delete a player",
     *     tags={"Players"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of player to delete",
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
    public function destroy(Player $player)
    {
        // Delete the player
        $player->delete();

        // Return the player
        return response()->noContent();
    }
}
