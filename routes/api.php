<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GamesController;


Route::get('/', function(){return response()->json(['sucess' => true]);});

Route::get('/jogo', [GamesController::class,'index']);
Route::get('/jogo/{id}', [GamesController::class,'show']);
Route::post('/jogo', [GamesController::class,'store']);
Route::delete('/jogo/{id}', [GamesController::class,'destroy']);
Route::put('/jogo/{id}', [GamesController::class,'update']);