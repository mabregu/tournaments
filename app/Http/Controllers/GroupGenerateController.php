<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Tournament;
use Termwind\Components\Dd;

class GroupGenerateController extends Controller
{
    /**
     * Generate groups according to number of players
     */
    public function store(Tournament $tournament)
    {
        try {
            // Get the number of players
            $players = $tournament->players()->count();

            // Get the number of groups. Half of the players in each group
            $groups = $players / Group::PLAYERS;

            // Create the groups
            for ($i = 0; $i < $groups; $i++) {
                $group = new Group();
                $group->name = 'Group ' . ($i + 1);
                $group->tournament_id = $tournament->id;
                $group->save();
            }

            // Get the groups
            $groups = $tournament->groups()->get();

            // Get the players
            $players = $tournament->players()->get();

            // Add players to groups
            $i = 0;
            foreach ($players as $player) {
                $groups[$i]->players()->attach($player->id);
                $i++;
                if ($i == $groups->count()) {
                    $i = 0;
                }
            }

            // Return the groups with players
            return $groups->load('players');
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }
}