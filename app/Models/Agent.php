<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * REA Model: Agent
 * Represents internal or external economic agents who participate in events.
 */
class Agent extends Model
{
    use HasFactory;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'type', // 'internal', 'external', 'organization'
        'role',
        'company_name',
        'email',
        'phone',
        'avatar',
        'website',
        'metadata',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'metadata' => 'array',
    ];

    /**
     * An agent participates in multiple economic events.
     */
    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }
}
