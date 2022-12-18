<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Group;
use App\Models\Tournament;
use Termwind\Components\Dd;
use Illuminate\Http\Request;

class TournamentController extends Controller
{    
    /**
     * @OA\Get(
     *     path="/api/tournaments",
     *     summary="Get all tournaments",
     *     tags={"Tournaments"},
     *     @OA\Response(
     *         response=200,
     *         description="Success"
     *     )
     * )
    */
    public function index()
    {
        return Tournament::latest()->paginate(10);
    }

    /**
     * @OA\Post(
     *     path="/api/tournaments",
     *     summary="Create a new tournament",
     *     tags={"Tournaments"},
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
            'name' => ['required', 'unique:tournaments', 'max:255', 'min:3'],
            'gender' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);

        // Create a new tournament
        $tournament = new Tournament();
        $tournament->name = $request->name;
        $tournament->gender = $request->gender;
        $tournament->start_date = $request->start_date;
        $tournament->end_date = $request->end_date;

        $tournament->save();

        // Add players to the tournament
        $tournament->players()->attach($request->players);

        // Return the tournament with players
        return $tournament->load('players');
    }

    /**
     * @OA\Get(
     *     path="/api/tournaments/{id}",
     *     summary="Get a tournament",
     *     tags={"Tournaments"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Tournament ID",
     *         required=true
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success"
     *     )
     * )
    */
    public function show(Tournament $id)
    {
        // Return the tournament with players
        return $id->load('players');
    }

    /**
     * @OA\Put(
     *     path="/api/tournaments/{id}",
     *     summary="Update a tournament",
     *     tags={"Tournaments"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Tournament ID",
     *         required=true
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
    public function update(Request $request, Tournament $tournament)
    {
        // Validate the request
        $request->validate([
            'name' => ['required', 'max:255', 'min:3'],
            'gender' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);

        // Update the tournament
        $tournament->name = $request->name;
        $tournament->gender = $request->gender;
        $tournament->start_date = $request->start_date;
        $tournament->end_date = $request->end_date;
        $tournament->save();

        // Return the tournament
        return $tournament;
    }

    /**
     * @OA\Delete(
     *     path="/api/tournaments/{id}",
     *     summary="Delete a tournament",
     *     tags={"Tournaments"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Tournament ID",
     *         required=true
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success"
     *     )
     * )
    */
    public function destroy(Tournament $tournament)
    {
        // Delete the tournament
        $tournament->delete();

        return response()->noContent();
    }
}
