<?php

namespace App\Http\Controllers;

use App\Models\Tournament;
use Illuminate\Http\JsonResponse;

class GameResolveController extends Controller
{
    /**
     * Resolve the games
     * @param Tournament $tournament
     * @return JsonResponse
     */
    public function store(Tournament $tournament)
    {
        try {
            // Get the groups
            $groups = $tournament->groups()->get();

            // Resolve the games
            foreach ($groups as $group) {
                $groupGames = $group->games()->get();

                foreach ($groupGames as $game) {
                    // Set score
                    $game->setScore(rand(0, 10), rand(0, 10));

                    // Resolve the game
                    $game->resolve();
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