<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Return all players
        return Player::latest()->paginate(10);
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
     * Display the specified resource.
     *
     * @param  \App\Models\Player  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Player $id)
    {
        // Return the player
        return $id;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Player  $player
     * @return \Illuminate\Http\Response
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
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function destroy(Player $player)
    {
        // Delete the player
        $player->delete();

        // Return the player
        return response()->noContent();
    }
}
