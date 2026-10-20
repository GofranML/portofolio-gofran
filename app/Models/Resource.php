<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * REA Model: Resource
 * Represents economic resources (e.g. projects, skills, certifications, strengths).
 */
class Resource extends Model
{
    use HasFactory;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'type', // 'project', 'skill', 'strength', 'certification', 'education'
        'category',
        'year',
        'description',
        'points',
        'stack',
        'image_url',
        'external_url',
        'is_featured',
        'sort_order',
        'metadata',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'points' => 'array',
        'stack' => 'array',
        'metadata' => 'array',
        'is_featured' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Economic events that consume, produce, or showcase this resource.
     */
    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class, 'event_resource')
            ->withPivot('relationship_type')
            ->withTimestamps();
    }
}
