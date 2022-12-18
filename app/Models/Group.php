<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Total number of players in a group
    const PLAYERS = 2;

    public function players()
    {
        return $this->belongsToMany(Player::class);
    }

    public function games()
    {
        return $this->hasMany(Game::class);
    }

    public function winner()
    {
        return $this->belongsTo(Player::class, 'winner_id');
    }

    public function loser()
    {
        return $this->belongsTo(Player::class, 'loser_id');
    }
}
