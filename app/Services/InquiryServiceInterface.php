<?php

declare(strict_types=1);

namespace App\Services;

use App\DTOs\InquiryDto;
use App\Models\Event;

interface InquiryServiceInterface
{
    /**
     * Record a contact or collaboration inquiry as an REA Event involving an external Agent.
     */
    public function recordInquiry(InquiryDto $dto): Event;
}
