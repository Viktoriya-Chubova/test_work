<?php

use App\Http\Controllers\Api\GitApiController;
use App\Http\Controllers\GitHubController;
use Illuminate\Support\Facades\Route;

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
    return ['Laravel' => app()->version()];
});


Route::get('/show_search',  [GitHubController::class, 'showSearch']);

Route::get('/api/find',  [GitApiController::class, 'show']);
Route::post('/api/find',  [GitApiController::class, 'show']);
Route::delete('/api/find/{id}',  [GitApiController::class, 'delete']);

require __DIR__ . '/auth.php';
