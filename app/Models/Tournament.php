<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Total number of players in a tournament
    const PLAYERS = 4;

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

    public function groups()
    {
        return $this->hasMany(Group::class);
    }

    public function scopeByGender($query, $gender)
    {
        return $query->where('gender', $gender);
    }

    public function scopeByDate($query, $date)
    {
        return $query->where('start_date', $date);
    }
}
