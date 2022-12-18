<?php

namespace Tests\Feature;

use App\Models\Player;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TournamentApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_tournament()
    {
        // Players
        $player1 = Player::factory()->create([
            'name' => 'Player 1'
        ]);

        $player2 = Player::factory()->create([
            'name' => 'Player 2'
        ]);

        $player3 = Player::factory()->create([
            'name' => 'Player 3'
        ]);

        $player4 = Player::factory()->create([
            'name' => 'Player 4'
        ]);

        $tournament = $this->postJson('/api/tournaments', [
            'name' => 'Tournament 1',
            'gender' => 'male',
            'start_date' => '2023-01-01',
            'end_date' => '2023-01-02',
            'players' => [
                $player1->id,
                $player2->id,
                $player3->id,
                $player4->id
            ]
        ]);

        $tournament->assertStatus(201);

        $this->assertDatabaseHas('tournaments', [
            'name' => 'Tournament 1'
        ]);

        $this->assertDatabaseHas('players', [
            'name' => 'Player 1'
        ]);

        $this->assertDatabaseHas('players', [
            'name' => 'Player 2'
        ]);

        $this->assertDatabaseHas('players', [
            'name' => 'Player 3'
        ]);

        $this->assertDatabaseHas('players', [
            'name' => 'Player 4'
        ]);

        // Generate groups
        $groups = $this->postJson('/api/actions/groups/generate/' . $tournament->json('id'));

        $groups->assertStatus(200);

        // Generate games
        $games = $this->postJson('/api/actions/games/generate/' . $tournament->json('id'));

        $games->assertStatus(200);

        // Resolve games
        $resolve = $this->postJson('/api/actions/games/resolve/' . $tournament->json('id'));

        $resolve->assertStatus(200);
    }
}