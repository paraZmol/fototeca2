<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Photographer extends Model
{
    protected $fillable = [
        'full_name',
        'birth_place',
        'birth_date',
        'death_place',
        'death_date',
        'bio',
        'studies_critique',
        'portrait_url',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'death_date' => 'date',
    ];

    public function photos(): BelongsToMany
    {
        return $this->belongsToMany(Photo::class, 'photo_photographer')->withPivot('role');
    }

    public function getDisplayNameAttribute(): string
    {
        return $this->full_name;
    }

    public function getInitialAttribute(): string
    {
        return mb_strtoupper(mb_substr($this->full_name, 0, 1));
    }

    public function getLifespanAttribute(): ?string
    {
        if (!$this->birth_date) {
            return null;
        }
        $birth = $this->birth_date->year;
        $death = $this->death_date ? $this->death_date->year : 'presente';
        return "({$birth} – {$death})";
    }

    public function getBirthYearAttribute(): ?int
    {
        return $this->birth_date?->year;
    }

    public function getDeathYearAttribute(): ?int
    {
        return $this->death_date?->year;
    }
}
