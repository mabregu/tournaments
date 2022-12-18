<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function tournament()
    {
        return $this->belongsTo(Tournament::class);
    }

    public function player1()
    {
        return $this->belongsTo(Player::class, 'player1_id');
    }

    public function player2()
    {
        return $this->belongsTo(Player::class, 'player2_id');
    }

    public function winner()
    {
        return $this->belongsTo(Player::class, 'winner_id');
    }

    public function loser()
    {
        return $this->belongsTo(Player::class, 'loser_id');
    }

    // Set the score
    public function setScore($score1, $score2)
    {
        $this->player1_score = $score1;
        $this->player2_score = $score2;
        $this->save();
    }

    // Resolve the game. Set the winner and loser
    public function resolve()
    {
        if ($this->player1_score > $this->player2_score) {
            $this->winner_id = $this->player1_id;
            $this->loser_id = $this->player2_id;
        } else {
            $this->winner_id = $this->player2_id;
            $this->loser_id = $this->player1_id;
        }

        $this->save();
    }
}
