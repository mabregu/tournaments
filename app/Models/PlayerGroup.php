<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerGroup extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function players()
    {
        return $this->belongsToMany(Player::class);
    }

    public function games()
    {
        return $this->hasMany(Game::class);
    }
}
