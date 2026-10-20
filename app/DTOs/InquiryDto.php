<?php

declare(strict_types=1);

namespace App\DTOs;

readonly class InquiryDto
{
    public function __construct(
        public string $name,
        public string $email,
        public string $subject,
        public string $message,
        public ?string $organization = null,
        public ?string $phone = null,
        public ?string $intendedRole = null,
        public ?string $visitorIp = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data, ?string $ip = null): self
    {
        return new self(
            name: (string) ($data['name'] ?? ''),
            email: (string) ($data['email'] ?? ''),
            subject: (string) ($data['subject'] ?? 'Peluang Kolaborasi'),
            message: (string) ($data['message'] ?? ''),
            organization: isset($data['organization']) && is_string($data['organization']) ? $data['organization'] : null,
            phone: isset($data['phone']) && is_string($data['phone']) ? $data['phone'] : null,
            intendedRole: isset($data['intended_role']) && is_string($data['intended_role']) ? $data['intended_role'] : null,
            visitorIp: $ip,
        );
    }
}
