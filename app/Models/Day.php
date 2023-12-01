<?php

namespace App\Models;

use App\Models\Team;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Day extends Model
{
    use HasFactory;


    public function teams(): HasMany
    {
        return $this->hasMany(Team::class);
    }

    protected $fillable = [
        'name',
    ];
}
