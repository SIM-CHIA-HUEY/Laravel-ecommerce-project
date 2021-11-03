<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\welcomeController;
use App\Http\Controllers\postadController;
use App\Http\Controllers\myadsController;
use App\Http\Controllers\TESTCTRL; //attention à bien l'ajouter
use App\Http\Controllers\addCtrl; //attention à bien l'ajouter

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

//Route::get('/', function () {return view('welcome');});

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
// User edit his own ads
Route::get('/myads', [myadsController::class, 'index']);
Route::get('/myads/{id}', [myadsController::class, 'getAd']);
Route::post('/myads', [myadsController::class, 'updateAd']);
Route::get('/myads/disable/{id}', [myadsController::class, 'disable']);
Route::get('/myads/enable/{id}', [myadsController::class, 'enable']);

// Switch between pages.
Route::get('/page/{number}', [welcomeController::class, 'displayPage']);

// Filters has been applied.
Route::post('/filters', [welcomeController::class, 'filters']);
Route::get('/filters', [welcomeController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', '\App\Http\Controllers\RoleController');
    Route::resource('users', '\App\Http\Controllers\UserController');
    Route::resource('ads', '\App\Http\Controllers\AdController');
});



Route::get('/blog', [\App\Http\Controllers\BlogPostController::class, 'index'])->middleware('auth');
Route::get('/blog/{blogPost}', [\App\Http\Controllers\BlogPostController::class, 'show']);
Route::get('/blog/create/post', [\App\Http\Controllers\BlogPostController::class, 'create']); //shows create post form
Route::post('/blog/create/post', [\App\Http\Controllers\BlogPostController::class, 'store']); //saves the created post to the databse
Route::get('/blog/{blogPost}/edit', [\App\Http\Controllers\BlogPostController::class, 'edit']); //shows edit post form
Route::put('/blog/{blogPost}/edit', [\App\Http\Controllers\BlogPostController::class, 'update']); //commits edited post to the database
Route::delete('/blog/{blogPost}', [\App\Http\Controllers\BlogPostController::class, 'destroy']); //deletes post from the database

Route::get('/guser', [TESTCTRL::class, 'showAccueil']); //L'utilisateur m'envoie un get sur la racine donc j'exécute
Route::post('/guser', [TESTCTRL::class, 'getVariable']); //L'utilisateur m'envoie un post sur la racine donc j'exécute getvariable
Route::post('/update', [TESTCTRL::class, 'setVariable']);

Route::get('/adduser', [addCtrl::class, 'show']);

//Route::redirect('/', '/adduser');
Route::post('/adduser', [addCtrl::class, 'addUser']);

require __DIR__.'/auth.php';
