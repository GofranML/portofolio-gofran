<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * REA Model: Event
 * Represents economic events/transactions (e.g. work experience, milestones, inquiries).
 */
class Event extends Model
{
    use HasFactory;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'agent_id',
        'title',
        'type', // 'work_experience', 'project_milestone', 'education_milestone', 'contact_inquiry'
        'organization',
        'role_title',
        'period',
        'start_date',
        'end_date',
        'is_current',
        'summary',
        'details',
        'metadata',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'details' => 'array',
        'metadata' => 'array',
        'is_current' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    /**
     * The economic agent that participated in this event.
     */
    public function agent(): BelongsTo
    {
        return $this->belongsTo(Agent::class);
    }

    /**
     * Resources associated with this event (Stockflow / Resource usage).
     */
    public function resources(): BelongsToMany
    {
        return $this->belongsToMany(Resource::class, 'event_resource')
            ->withPivot('relationship_type')
            ->withTimestamps();
    }
}
