<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\DTOs\InquiryDto;
use App\Http\Requests\StoreInquiryRequest;
use App\Services\InquiryServiceInterface;
use App\Services\PortfolioServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Controller for the REA-modeled Portfolio Application.
 * Complies with ECC: thin controller delegating business logic to explicit services.
 */
class PortfolioController extends Controller
{
    public function __construct(
        protected readonly PortfolioServiceInterface $portfolioService,
        protected readonly InquiryServiceInterface $inquiryService,
    ) {
    }

    /**
     * Display the portfolio home page with REA data.
     */
    public function index(): View
    {
        $portfolio = $this->portfolioService->getPortfolioData();

        return view('portfolio.index', compact('portfolio'));
    }

    /**
     * API endpoint exposing the REA (Resources, Events, Agents) ontology graph.
     */
    public function reaApi(): JsonResponse
    {
        $graph = $this->portfolioService->getReaGraph();

        return response()->json($graph);
    }

    /**
     * Store an inquiry/contact event from an external agent.
     */
    public function storeInquiry(StoreInquiryRequest $request): JsonResponse|RedirectResponse
    {
        $dto = InquiryDto::fromArray(
            data: $request->validated(),
            ip: $request->ip()
        );

        $event = $this->inquiryService->recordInquiry($dto);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Terima kasih! Pesan dan kolaborasi Anda telah berhasil dicatat ke dalam model REA.',
                'event_id' => $event->id,
                'agent_id' => $event->agent_id,
            ], 201);
        }

        return redirect()->to(url()->previous() . '#kontak')
            ->with('success', 'Pesan Anda berhasil dikirim! Terima kasih atas minat kolaborasi Anda.');
    }
}
