<?php

use App\Http\Controllers\postadController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\welcomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Classic index
Route::get('/', [welcomeController::class, 'index']);

// Filter by category
Route::get('/category/{category}', [welcomeController::class, 'displayCategory']);

// Search bar has been used.
Route::post('/search', [welcomeController::class, 'search']);
Route::get('/search', [welcomeController::class, 'index']);

// User posted a new ad.
Route::get('/postad', [postadController::class, 'index']);
Route::post('/postad', [postadController::class, 'post']);

// Switch between pages.
Route::get('/page/{number}', [welcomeController::class, 'displayPage']);

// Filters has been applied.
Route::post('/filters', [welcomeController::class, 'filters']);
Route::get('/filters', [welcomeController::class, 'index']);

require __DIR__.'/auth.php';
