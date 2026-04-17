<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Photographer extends Model
{
    protected $fillable = [
        'name',
        'pseudonym',
        'birth_year',
        'death_year',
        'nationality',
        'biography',
        'portrait_path',
        'is_anonymous',
    ];

    protected $casts = [
        'is_anonymous' => 'boolean',
    ];

    public function photos(): BelongsToMany
    {
        return $this->belongsToMany(Photo::class, 'photo_photographer')->withPivot('role');
    }

    public function getInitialAttribute(): string
    {
        return mb_strtoupper(mb_substr($this->name, 0, 1));
    }

    public function getDisplayNameAttribute(): string
    {
        if ($this->is_anonymous) {
            return 'Autor desconocido';
        }
        return $this->pseudonym ?? $this->name;
    }

    public function getLifespanAttribute(): ?string
    {
        if (!$this->birth_year) {
            return null;
        }
        $death = $this->death_year ?? 'presente';
        return "({$this->birth_year} – {$death})";
    }
}
