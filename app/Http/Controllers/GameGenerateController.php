<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Tournament;

class GameGenerateController extends Controller
{
    /**
     * Generate games according to number of players
     */
    public function store(Tournament $tournament)
    {
        try {
            // Get the groups
            $groups = $tournament->groups()->get();

            // Create the games
            foreach ($groups as $group) {
                $groupPlayers = $group->players()->get();

                $i = 0;
                foreach ($groupPlayers as $player) {
                    $j = $i + 1;

                    while ($j < $groupPlayers->count()) {
                        $game = new Game();
                        $game->group_id = $group->id;
                        $game->player1_id = $player->id;
                        $game->player2_id = $groupPlayers[$j]->id;
                        $game->save();
                        $j++;
                    }
                    $i++;
                }
            }

            // Return the games
            return $tournament->groups()->with('games')->get();
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }
}