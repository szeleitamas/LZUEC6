<?php

namespace App\Models;

use App\Models\Team;
use App\Models\Turn;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Game extends Model
{
    use HasFactory;

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    public function turn(): BelongsTo
    {
        return $this->belongsTo(Turn::class);
    }

    public function homeTeam(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'homeTeam_id');
    }

    public function awayTeam(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'awayTeam_id');
    }



    protected $fillable = [
        'group_id',
        'turn_id',
        'homeTeam_id',
        'awayTeam_id',
        'homePlayer1_id',
        'awayPlayer1_id',
        'homePlayer1Point',
        'awayPlayer1Point',
        'homePlayer2_id',
        'awayPlayer2_id',
        'homePlayer2Point',
        'awayPlayer2Point',
        'homePPlayer1_id',
        'homePPlayer2_id',
        'awayPPlayer1_id',
        'awayPPlayer2_id',
        'homePPlayerPoint',
        'awayPPlayerPoint',
    ];
}
