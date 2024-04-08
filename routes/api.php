<?php

use App\Http\Controllers\AgendaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ClientsAgendaController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SocialController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::resource('posts',PostController::class);
Route::resource('agendas',AgendaController::class);
Route::resource('clients',ClientController::class);
Route::resource('socials',SocialController::class);
Route::resource('clientsagendas',ClientsAgendaController::class);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('login',[AuthController::class,'login']);
Route::post('logout',[AuthController::class,'logout']);