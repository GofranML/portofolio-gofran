<?php

declare(strict_types=1);

use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PortfolioController::class, 'index'])->name('portfolio.index');
Route::get('/api/rea-graph', [PortfolioController::class, 'reaApi'])->name('api.rea-graph');
Route::post('/inquiry', [PortfolioController::class, 'storeInquiry'])->middleware('throttle:6,1')->name('portfolio.inquiry');

Route::get('/sitemap.xml', function () {
    $path = public_path('sitemap.xml');
    if (file_exists($path)) {
        return response(file_get_contents($path), 200, [
            'Content-Type' => 'application/xml; charset=UTF-8',
        ]);
    }
    abort(404);
})->name('sitemap');

Route::get('/manifest.webmanifest', function () {
    $path = public_path('manifest.webmanifest');
    if (file_exists($path)) {
        return response(file_get_contents($path), 200, [
            'Content-Type' => 'application/manifest+json; charset=UTF-8',
        ]);
    }
    abort(404);
})->name('manifest.webmanifest');

Route::get('/manifest.json', function () {
    $path = public_path('manifest.json');
    if (file_exists($path)) {
        return response(file_get_contents($path), 200, [
            'Content-Type' => 'application/manifest+json; charset=UTF-8',
        ]);
    }
    abort(404);
})->name('manifest.json');
