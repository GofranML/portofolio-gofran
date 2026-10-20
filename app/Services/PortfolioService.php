<?php

declare(strict_types=1);

namespace App\Services;

use App\DTOs\PortfolioDataDto;
use App\Models\Agent;
use App\Models\Event;
use App\Models\Resource;

class PortfolioService implements PortfolioServiceInterface
{
    /**
     * Retrieve aggregated portfolio domain data structured via REA.
     */
    public function getPortfolioData(): PortfolioDataDto
    {
        /** @var Agent $owner */
        $owner = Agent::where('type', 'internal')->first() ?? new Agent([
            'name' => 'Gofran Muttaqi Likhan',
            'type' => 'internal',
            'role' => 'Mahasiswa Informatika',
            'avatar' => '/gofran-profile.png',
            'email' => 'gofranmuttaqi@gmail.com',
        ]);

        // Featured Projects (Resources: type = project)
        $projects = Resource::where('type', 'project')
            ->where('is_featured', true)
            ->orderBy('sort_order')
            ->get();

        // Skill Groups (Resources: type = skill)
        $skills = Resource::where('type', 'skill')
            ->orderBy('sort_order')
            ->get();

        $skillGroups = [];
        foreach ($skills as $skill) {
            $category = $skill->category ?? 'Lainnya';
            $skillGroups[$category][] = $skill;
        }

        // Strengths (Resources: type = strength)
        $strengths = Resource::where('type', 'strength')
            ->orderBy('sort_order')
            ->get();

        // Certifications (Resources: type = certification)
        $certifications = Resource::where('type', 'certification')
            ->orderBy('sort_order')
            ->get();

        $certificationGroups = [];
        foreach ($certifications as $cert) {
            $group = $cert->category ?? 'Sertifikasi';
            $meta = $cert->metadata['meta_label'] ?? '';
            $certificationGroups[$group][] = [
                'title' => $cert->title,
                'meta' => $meta,
            ];
        }

        // Education (Resource: type = education)
        $education = Resource::where('type', 'education')->first();

        // Work Experiences (Events: type = work_experience) with participating Agents & Resources
        $experiences = Event::where('type', 'work_experience')
            ->with(['agent', 'resources'])
            ->orderByDesc('is_current')
            ->orderBy('id')
            ->get();

        // REA Model Statistics
        $reaStats = [
            'agents_count' => Agent::count(),
            'resources_count' => Resource::count(),
            'events_count' => Event::count(),
            'internal_agent' => $owner->name,
            'external_agents' => Agent::where('type', '!=', 'internal')->pluck('name')->toArray(),
            'resource_types' => Resource::select('type')->distinct()->pluck('type')->toArray(),
            'event_types' => Event::select('type')->distinct()->pluck('type')->toArray(),
        ];

        return new PortfolioDataDto(
            owner: $owner,
            projects: $projects,
            skillGroups: $skillGroups,
            strengths: $strengths,
            certificationGroups: $certificationGroups,
            education: $education,
            experiences: $experiences,
            reaStats: $reaStats,
        );
    }

    /**
     * Retrieve the structured graph of Resources, Events, and Agents for analysis.
     *
     * @return array<string, mixed>
     */
    public function getReaGraph(): array
    {
        return [
            'meta' => [
                'model' => 'REA (Resources, Events, Agents) Ontology',
                'application' => 'Gofran Muttaqi Likhan Portfolio',
                'framework' => 'Laravel 12 / ECC Framework',
                'timestamp' => now()->toIso8601String(),
            ],
            'agents' => Agent::withCount('events')->get()->map(function (Agent $agent) {
                return [
                    'id' => $agent->id,
                    'name' => $agent->name,
                    'type' => $agent->type,
                    'role' => $agent->role,
                    'company' => $agent->company_name,
                    'events_participated' => $agent->events_count,
                ];
            })->values()->all(),
            'resources' => Resource::withCount('events')->get()->map(function (Resource $res) {
                return [
                    'id' => $res->id,
                    'title' => $res->title,
                    'type' => $res->type,
                    'category' => $res->category,
                    'events_associated' => $res->events_count,
                ];
            })->values()->all(),
            'events' => Event::with(['agent', 'resources'])->get()->map(function (Event $ev) {
                return [
                    'id' => $ev->id,
                    'title' => $ev->title,
                    'type' => $ev->type,
                    'organization' => $ev->organization,
                    'agent' => $ev->agent?->name,
                    'resources_involved' => $ev->resources->pluck('title')->values()->all(),
                    'period' => $ev->period,
                ];
            })->values()->all(),
        ];
    }
}
