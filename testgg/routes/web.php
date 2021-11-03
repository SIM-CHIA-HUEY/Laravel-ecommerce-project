<?php

use Illuminate\Support\Facades\Route;
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



      

Route::get('/guser', [TESTCTRL::class, 'showAccueil']); //L'utilisateur m'envoie un get sur la racine donc j'exécute
Route::post('/guser', [TESTCTRL::class, 'getVariable']); //L'utilisateur m'envoie un post sur la racine donc j'exécute getvariable
Route::post('/update', [TESTCTRL::class, 'setVariable']);

Route::get('/adduser', [addCtrl::class, 'show']);

//Route::redirect('/', '/adduser');
Route::post('/adduser', [addCtrl::class, 'addUser']);
