<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function stats()
    {
        return $this->hasMany(Stat::class);
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class);
    }

    public function getFullNameAttribute()
    {
        return $this->name;
    }
}
