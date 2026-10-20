<?php

declare(strict_types=1);

namespace App\Services;

use App\DTOs\InquiryDto;
use App\Models\Agent;
use App\Models\Event;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InquiryService implements InquiryServiceInterface
{
    /**
     * Record a contact or collaboration inquiry as an REA Event involving an external Agent.
     */
    public function recordInquiry(InquiryDto $dto): Event
    {
        return DB::transaction(function () use ($dto): Event {
            // 1. External Economic Agent
            $agent = Agent::firstOrCreate(
                ['email' => $dto->email],
                [
                    'name' => $dto->name,
                    'type' => 'external',
                    'role' => $dto->intendedRole ?? 'Prospective Collaborator / Employer',
                    'company_name' => $dto->organization,
                    'phone' => $dto->phone,
                    'metadata' => [
                        'first_seen_ip' => $dto->visitorIp,
                        'source' => 'web_portfolio_contact_form',
                    ],
                ]
            );

            // Update details if previously created without organization or phone
            if ($dto->organization && empty($agent->company_name)) {
                $agent->company_name = $dto->organization;
                $agent->save();
            }

            // 2. Economic Event: Contact / Inquiry Event
            $event = Event::create([
                'agent_id' => $agent->id,
                'title' => 'Inquiry: ' . $dto->subject,
                'type' => 'contact_inquiry',
                'organization' => $dto->organization ?? $agent->company_name,
                'role_title' => 'Visitor / Recruiter',
                'period' => now()->translatedFormat('d F Y, H:i'),
                'start_date' => now(),
                'is_current' => false,
                'summary' => $dto->subject,
                'details' => [
                    'message' => $dto->message,
                    'intended_role' => $dto->intendedRole,
                ],
                'metadata' => [
                    'ip' => $dto->visitorIp,
                    'user_agent' => request()->userAgent(),
                ],
            ]);

            Log::info('REA Contact Inquiry Event recorded', [
                'event_id' => $event->id,
                'agent_name' => $agent->name,
                'subject' => $dto->subject,
            ]);

            return $event;
        });
    }
}
