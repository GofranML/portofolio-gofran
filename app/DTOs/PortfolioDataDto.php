<?php

declare(strict_types=1);

namespace App\DTOs;

use App\Models\Agent;
use App\Models\Resource;
use Illuminate\Database\Eloquent\Collection;

readonly class PortfolioDataDto
{
    /**
     * @param Collection<int, Resource> $projects
     * @param array<string, array<int, Resource>> $skillGroups
     * @param Collection<int, Resource> $strengths
     * @param array<string, array<int, array{title: string, meta: string}>> $certificationGroups
     * @param Collection<int, \App\Models\Event> $experiences
     * @param array<string, mixed> $reaStats
     */
    public function __construct(
        public Agent $owner,
        public Collection $projects,
        public array $skillGroups,
        public Collection $strengths,
        public array $certificationGroups,
        public ?Resource $education,
        public Collection $experiences,
        public array $reaStats,
    ) {
    }
}
