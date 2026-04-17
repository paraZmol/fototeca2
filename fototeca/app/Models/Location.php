<?php

namespace App\Models;

use App\Enums\LocationType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{
    protected $fillable = ['parent_id', 'name', 'type'];

    protected $casts = ['type' => LocationType::class];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Location::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Location::class, 'parent_id')->orderBy('name');
    }

    public function allChildren(): HasMany
    {
        return $this->children()->with('allChildren');
    }

    public function photos(): HasMany
    {
        return $this->hasMany(Photo::class);
    }

    public function scopeProvinces($query)
    {
        return $query->where('type', LocationType::Province);
    }

    /**
     * Returns IDs of this location and all descendants using O(depth) queries
     * instead of one query per node.
     */
    public static function descendantIds(int $rootId): array
    {
        $ids   = [$rootId];
        $queue = [$rootId];

        while ($queue) {
            $children = static::whereIn('parent_id', $queue)->pluck('id')->all();
            $ids      = array_merge($ids, $children);
            $queue    = $children;
        }

        return $ids;
    }
}
