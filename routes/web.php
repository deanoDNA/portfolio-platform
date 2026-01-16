<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\DashboardController;

use App\Http\Controllers\LocationController;
use App\Http\Controllers\PublicPortfolioController;

// Landing page
Route::get('/', function () {
    return view('landing.home');
})->name('landing');

// Public APIs
Route::get('/regions/{country}', [LocationController::class, 'regions'])->name('regions.byCountry');
Route::get('/districts/{region}', [LocationController::class, 'districts'])->name('districts.byRegion');

// Authenticated routes
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Skills
    Route::get('/skills', [SkillController::class, 'index'])->name('skills.index');
    Route::post('/skills', [SkillController::class, 'store'])->name('skills.store');
    Route::delete('/skills/{skill}', [SkillController::class, 'destroy'])->name('skills.destroy');

    // Portfolio edit/update
    Route::get('/portfolio/edit', [PortfolioController::class, 'edit'])->name('portfolio.edit');
    Route::post('/portfolio/edit', [PortfolioController::class, 'update'])->name('portfolio.update');
    Route::post('/portfolio/update-photo', [PortfolioController::class, 'updatePhoto'])->name('portfolio.updatePhoto');

    // Multi-step portfolio creation
    Route::prefix('portfolio')->group(function () {

        // Step 1
        Route::get('step-1', [PortfolioController::class, 'step1'])->name('portfolio.step1');
        Route::post('store-step-1', [PortfolioController::class, 'storeStep1'])->name('portfolio.storeStep1');

        // Step 2
        Route::get('step-2', [PortfolioController::class, 'step2'])->name('portfolio.step2');
        Route::post('store-step-2', [PortfolioController::class, 'storeStep2'])->name('portfolio.storeStep2');

        // Step 3
        Route::get('step-3', [PortfolioController::class, 'step3'])->name('portfolio.step3');
        Route::post('store-step-3', [PortfolioController::class, 'storeStep3'])->name('portfolio.storeStep3');

        // Step 4
        Route::get('step-4', [PortfolioController::class, 'step4'])->name('portfolio.step4');
        Route::post('store-step-4', [PortfolioController::class, 'storeStep4'])->name('portfolio.storeStep4');

        // Step 5
        Route::get('step-5', [PortfolioController::class, 'step5'])->name('portfolio.step5');

        // Download portfolio
        Route::get('download', [PortfolioController::class, 'download'])->name('portfolio.download');
    });
});

// Public Portfolio view
Route::get('/@{username}', [PortfolioController::class, 'show'])->name('portfolio.show');
Route::get('/public-portfolio/{portfolio}', [PublicPortfolioController::class, 'show'])->name('portfolio.public');

// Include auth routes
require __DIR__.'/auth.php';
