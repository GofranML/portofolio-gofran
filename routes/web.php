<?php

declare(strict_types=1);

use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PortfolioController::class, 'index'])->name('portfolio.index');
Route::get('/api/rea-graph', [PortfolioController::class, 'reaApi'])->name('api.rea-graph');
Route::post('/inquiry', [PortfolioController::class, 'storeInquiry'])->name('portfolio.inquiry');
