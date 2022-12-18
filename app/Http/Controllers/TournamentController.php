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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Tournament::latest()->paginate(10);
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
     * Display the specified resource.
     *
     * @param  \App\Models\Tournament  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Tournament $id)
    {
        // Return the tournament with players
        return $id->load('players');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tournament  $tournament
     * @return \Illuminate\Http\Response
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
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tournament  $tournament
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tournament $tournament)
    {
        // Delete the tournament
        $tournament->delete();

        return response()->noContent();
    }

    // Generate groups according to number of players
    public function generateGroups(Tournament $id)
    {
        // Get the tournament
        $tournament = $id;

        // Get the players
        $players = $tournament->players;

        // Get the number of players
        $numOfPlayers = $players->count();

        // Check if the number of players is even
        if ($numOfPlayers % 2 == 0) {
            // Generate Group A and Group B
            $groupA = new Group();
            $groupA->name = 'Group A';
            $groupA->tournament_id = $tournament->id;
            $groupA->save();

            $groupB = new Group();
            $groupB->name = 'Group B';
            $groupB->tournament_id = $tournament->id;
            $groupB->save();

            // Add players to the groups
            $groupA->players()->attach($players->take($numOfPlayers / 2));
            $groupB->players()->attach($players->skip($numOfPlayers / 2));
        } else {
            // If odd, return error
            return response()->json([
                'message' => 'The number of players must be even'
            ], 400);
        }

        // Return the tournament with players and games
        return $tournament->load('players', 'games');
    }

    // Generate matches according groups
    public function generateMatches(Tournament $id)
    {
        // Get the tournament
        $tournament = $id;

        // Get the groups
        $groupA = $tournament->groups->first();
        $groupB = $tournament->groups->last();

        // Generate matches for Group A
        $groupAPlayers = $groupA->players;
        $groupAPlayersCount = $groupAPlayers->count();

        for ($i = 0; $i < $groupAPlayersCount; $i++) {
            for ($j = $i + 1; $j < $groupAPlayersCount; $j++) {
                $game = new Game();
                $game->tournament_id = $tournament->id;
                $game->group_id = $groupA->id;
                $game->player1_id = $groupAPlayers[$i]->id;
                $game->player2_id = $groupAPlayers[$j]->id;
                $game->save();
            }
        }

        // Generate matches for Group B
        $groupBPlayers = $groupB->players;
        $groupBPlayersCount = $groupBPlayers->count();

        for ($i = 0; $i < $groupBPlayersCount; $i++) {
            for ($j = $i + 1; $j < $groupBPlayersCount; $j++) {
                $game = new Game();
                $game->tournament_id = $tournament->id;
                $game->group_id = $groupB->id;
                $game->player1_id = $groupBPlayers[$i]->id;
                $game->player2_id = $groupBPlayers[$j]->id;
                $game->save();
            }
        }

        return $this;
    }

    // Generate winners according to matches
    public function generateWinners(Tournament $id)
    {
        // Get the tournament
        $tournament = $id;

        // Get the groups
        $groupA = $tournament->groups->first();
        $groupB = $tournament->groups->last();

        // Get the games
        $groupAGames = $groupA->games;
        $groupBGames = $groupB->games;

        // Get the number of games
        $groupAGamesCount = $groupAGames->count();
        $groupBGamesCount = $groupBGames->count();

        // Generate winners for Group A
        for ($i = 0; $i < $groupAGamesCount; $i++) {
            $game = $groupAGames[$i];

            if ($game->player1_score > $game->player2_score) {
                $game->winner_id = $game->player1_id;
            } else {
                $game->winner_id = $game->player2_id;
            }

            $game->save();
        }

        // Generate winners for Group B
        for ($i = 0; $i < $groupBGamesCount; $i++) {
            $game = $groupBGames[$i];

            if ($game->player1_score > $game->player2_score) {
                $game->winner_id = $game->player1_id;
            } else {
                $game->winner_id = $game->player2_id;
            }

            $game->save();
        }

        return $this;
    }
}
