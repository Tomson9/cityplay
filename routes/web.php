<?php

use App\Http\Controllers\Admin\GameController;
use App\Http\Controllers\Admin\PlaceController;
use App\Http\Controllers\Admin\RiddleController;
use App\Http\Controllers\GameSessionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;



Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin'       => Route::has('login'),
        'canRegister'    => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion'     => PHP_VERSION,
    ]);
});


Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});

/*
|--------------------------------------------------------------------------
| Admin Games CRUD
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::resource('games', GameController::class);
    Route::resource('places', PlaceController::class);
    Route::resource('riddles', RiddleController::class);

});


/*
|--------------------------------------------------------------------------
| Player
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Games et/ou Sessions
    |--------------------------------------------------------------------------
    */

    Route::get('/games', [GameController::class, 'index'])
        ->name('games.index');

    Route::get('/gamesession', [GameSessionController::class, 'index'])
        ->name('gamesession.index');

    Route::get('/gamesession/{game}/start', [GameSessionController::class, 'create'])
        ->name('gamesession.start');

    Route::post('/gamesession/{game}/start', [GameSessionController::class, 'store'])
        ->name('games.storeSession');

    Route::delete('/gamesession/{session}', [GameSessionController::class, 'destroy'])
    ->name('gamesession.destroy');

    Route::get('/gamesession/{session}', [GameSessionController::class, 'show'])
        ->name('gamesession.show');


        // Route::get('/gamesession', [GameSessionController::class, 'index'])
    //     ->name('gamesession.index');



    // Route::post('/gamesession/{session}/validate-place', [GameSessionController::class, 'validatePlace'])
    //     ->name('gamesession.validatePlace');

});

require __DIR__.'/auth.php';