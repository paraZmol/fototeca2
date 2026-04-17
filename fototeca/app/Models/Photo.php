<?php

namespace App\Models;

use App\Enums\HistoricalPeriod;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Photo extends Model
{
    protected $fillable = [
        'title',
        'description',
        'year',
        'circa',
        'location_id',
        'historical_period',
        'original_format',
        'source_archive',
        'source_reference',
        'image_path',
        'image_url',
        'is_published',
    ];

    protected $casts = [
        'circa'             => 'boolean',
        'is_published'      => 'boolean',
        'historical_period' => HistoricalPeriod::class,
    ];

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function photographers(): BelongsToMany
    {
        return $this->belongsToMany(Photographer::class, 'photo_photographer')->withPivot('role');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'photo_category');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'photo_tag');
    }

    public function getImageSrcAttribute(): string
    {
        if ($this->image_path) {
            return asset('storage/' . $this->image_path);
        }
        return $this->image_url ?? 'https://picsum.photos/seed/nophoto/800/600';
    }

    public function getYearLabelAttribute(): string
    {
        if (!$this->year) {
            return 'Fecha desconocida';
        }
        return ($this->circa ? 'ca. ' : '') . $this->year;
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }
}
