<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\DashboardController;

use App\Http\Controllers\LocationController;
use App\Http\Controllers\PublicPortfolioController;

Route::get('/regions/{country}', [LocationController::class, 'regions']);
Route::get('/districts/{region}', [LocationController::class, 'districts']);


Route::get('/', function () {
    return view('landing.home');
})-> name('landing');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/skills', [SkillController::class, 'index'])->name('skills.index');
    Route::post('/skills', [SkillController::class, 'store'])->name('skills.store');
    Route::delete('/skills/{skill}', [SkillController::class, 'destroy'])->name('skills.destroy');

    Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

    Route::get('/portfolio/edit', [PortfolioController::class, 'edit'])
        ->name('portfolio.edit');

    Route::post('/portfolio/edit', [PortfolioController::class, 'update'])
        ->name('portfolio.update');
});

Route::get('/portfolio/create', function () {
    return view('portfolio.create');
});


Route::get('/portfolio/create/step-1', function () {
    return view('portfolio.steps.personal');
});



Route::get('/api/regions/{country}', [LocationController::class, 'regions']);
Route::get('/api/districts/{regionId}', [LocationController::class, 'districts']);



Route::get('/portfolio/create/step-1', function () {
    return view('portfolio.steps.personal');
});

Route::get('/regions/{country}', [LocationController::class, 'regions']);
Route::get('/districts/{region}', [LocationController::class, 'districts']);

Route::get('/portfolio/create/step-1', [PortfolioController::class, 'createStep1']);


Route::post('/portfolio/store/step-1', [PortfolioController::class, 'storeStep1'])
    ->name('portfolio.storeStep1');


// Step 1: show form
Route::get('/portfolio/create/step-1', [PortfolioController::class, 'createStep1'])->name('portfolio.step1');

// Step 1: handle form submission
Route::post('/portfolio/create/step-1', [PortfolioController::class, 'storeStep1'])->name('portfolio.storeStep1');


Route::get('/regions/{country}', [LocationController::class, 'regions']);
Route::get('/districts/{region}', [LocationController::class, 'districts']);



Route::middleware(['auth'])->group(function () {

    Route::get('/portfolio/create/step-1', [PortfolioController::class, 'step1'])
        ->name('portfolio.step1');

    Route::post('/portfolio/store/step-1', [PortfolioController::class, 'storeStep1'])
        ->name('portfolio.storeStep1');

    Route::get('/portfolio/create/step-2', [PortfolioController::class, 'step2'])
        ->name('portfolio.step2');

});

    Route::post('/portfolio/store/step-2', [PortfolioController::class, 'storeStep2'])
        ->name('portfolio.storeStep2');

    Route::get('/portfolio/create/step-3', [PortfolioController::class, 'step3'])->name('portfolio.step3');
        Route::post('/portfolio/store/step-3', [PortfolioController::class, 'storeStep3'])->name('portfolio.storeStep3');

        Route::get('/portfolio/create/step-4', [PortfolioController::class, 'step4'])->name('portfolio.step4');
        Route::post('/portfolio/store/step-4', [PortfolioController::class, 'storeStep4'])->name('portfolio.storeStep4');

        Route::get('/portfolio/create/step-5', [PortfolioController::class, 'step5'])->name('portfolio.step5');


    /*
    |--------------------------------------------------------------------------
    | Public Portfolio Route
    |--------------------------------------------------------------------------
    | Example: /@john
    */
    Route::get('/@{username}', [PortfolioController::class, 'show'])
        ->name('portfolio.show');


    Route::get('/portfolio/download', [PortfolioController::class, 'download'])
    ->name('portfolio.download');

    Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');
    });


Route::middleware('auth')->group(function () {

    Route::get('/regions/{country}', [LocationController::class, 'regions'])
        ->name('regions.byCountry');

    Route::get('/districts/{region}', [LocationController::class, 'districts'])
        ->name('districts.byRegion');
});

Route::get('/public-portfolio/{portfolio}', [PublicPortfolioController::class, 'show'])
    ->name('portfolio.public');

Route::post('/portfolio/update-photo',
    [PortfolioController::class, 'updatePhoto']
)->name('portfolio.updatePhoto');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/portfolio/step-1', [PortfolioController::class, 'step1'])->name('portfolio.step1');
    Route::post('/portfolio/store-step-1', [PortfolioController::class, 'storeStep1'])->name('portfolio.storeStep1');

    Route::get('/portfolio/step-2', [PortfolioController::class, 'step2'])->name('portfolio.step2');
    Route::post('/portfolio/store-step-2', [PortfolioController::class, 'storeStep2'])->name('portfolio.storeStep2');

    Route::get('/portfolio/step-3', [PortfolioController::class, 'step3'])->name('portfolio.step3');
    Route::post('/portfolio/store-step-3', [PortfolioController::class, 'storeStep3'])->name('portfolio.storeStep3');

    Route::get('/portfolio/step-4', [PortfolioController::class, 'step4'])->name('portfolio.step4');
    Route::post('/portfolio/store-step-4', [PortfolioController::class, 'storeStep4'])->name('portfolio.storeStep4');

    Route::get('/portfolio/step-5', [PortfolioController::class, 'step5'])->name('portfolio.step5');
});

Route::post('/portfolio/update-photo', [PortfolioController::class, 'updatePhoto'])
     ->name('portfolio.updatePhoto')
     ->middleware('auth');


     Route::middleware(['auth'])->group(function () {

    Route::get('/portfolio/create/step-1', [PortfolioController::class, 'step1'])
        ->name('portfolio.step1');

    Route::post('/portfolio/store/step-1', [PortfolioController::class, 'storeStep1'])
        ->name('portfolio.storeStep1');

    Route::get('/portfolio/create/step-2', [PortfolioController::class, 'step2'])
        ->name('portfolio.step2');

});




require __DIR__.'/auth.php';
