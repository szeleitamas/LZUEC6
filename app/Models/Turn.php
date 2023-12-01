<?php

namespace App\Models;

use App\Models\Game;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Turn extends Model
{
    use HasFactory;

    public function games(): HasMany
    {
        return $this->hasMany(Game::class);
    }

    protected $fillable = [
        'name',
    ];

}
