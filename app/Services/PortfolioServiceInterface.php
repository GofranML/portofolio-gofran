<?php

declare(strict_types=1);

namespace App\Services;

use App\DTOs\PortfolioDataDto;

interface PortfolioServiceInterface
{
    /**
     * Retrieve aggregated portfolio domain data structured via REA.
     */
    public function getPortfolioData(): PortfolioDataDto;

    /**
     * Retrieve the structured graph of Resources, Events, and Agents for analysis.
     *
     * @return array<string, mixed>
     */
    public function getReaGraph(): array;
}
