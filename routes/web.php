<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VotingPoolController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/voting_pools', [VotingPoolController::class, 'store'])->name('voting_pools.store');
Route::get('/user_voting_pools', [VotingPoolController::class, 'index'])->name('user_voting_pools.index');
Route::get('/voting_pools/{id}', [VotingPoolController::class, 'show'])->name('voting_pools.show');
Route::post('/voting_pools/{id}/submit', [VotingPoolController::class, 'submit'])->name('voting_pools.submit');