<?php

namespace App\Models;

use App\Models\Day;
use App\Models\Game;
use App\Models\User;
use App\Models\Group;
use App\Models\Track;
use App\Models\Result;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Team extends Model
{
    use HasFactory;

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function day(): BelongsTo
    {
        return $this->belongsTo(Day::class);
    }

    public function track(): BelongsTo
    {
        return $this->belongsTo(Track::class);
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    public function homeTeam(): HasMany
    {
        return $this->hasMany(Game::class, 'homeTeam_id');
    }

    public function awayTeam(): HasMany
    {
        return $this->hasMany(Game::class, 'awayTeam_id');
    }


    protected $fillable = [
        'name',
        'lot',
        'start_date',
        'day_id',
        'track_id',
        'group_id',
    ];
}
