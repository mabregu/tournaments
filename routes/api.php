<?php

use Illuminate\Support\Facades\Route;

// Group all routes under /api

// GET /api/tournaments
Route::group(['prefix' => 'tournaments'], function () {
    // GET /api/tournaments
    Route::get('/', 'App\Http\Controllers\TournamentController@index');
    // GET /api/tournaments/{id}
    Route::get('/{id}', 'App\Http\Controllers\TournamentController@show');
    // POST /api/tournaments
    Route::post('/', 'App\Http\Controllers\TournamentController@store');
    // PUT /api/tournaments/{id}
    Route::put('/{id}', 'App\Http\Controllers\TournamentController@update');

    // GET /api/tournaments/gender/{gender}
    Route::get('/gender/{gender}', 'App\Http\Controllers\TournamentByController@gender');
    // GET /api/tournaments/date/{date}
    Route::get('/date/{date}', 'App\Http\Controllers\TournamentByController@date');
});

// Group /api/players
Route::group(['prefix' => 'players'], function () {
    // GET /api/players
    Route::get('/', 'App\Http\Controllers\PlayerController@index');
    // GET /api/players/{id}
    Route::get('/{id}', 'App\Http\Controllers\PlayerController@show');
    // POST /api/players
    Route::post('/', 'App\Http\Controllers\PlayerController@store');
    // PUT /api/players/{id}
    Route::put('/{id}', 'App\Http\Controllers\PlayerController@update');
});

// Group /api/games
Route::group(['prefix' => 'games'], function () {
    // GET /api/games
    Route::get('/', 'App\Http\Controllers\GameController@index');
    // GET /api/games/{id}
    Route::get('/{id}', 'App\Http\Controllers\GameController@show');
    // POST /api/games
    Route::post('/', 'App\Http\Controllers\GameController@store');
    // PUT /api/games/{id}
    Route::put('/{id}', 'App\Http\Controllers\GameController@update');
});

// Group /api/actions
Route::group(['prefix' => 'actions'], function () {
    // GET /api/actions/groups/generate
    Route::post('/groups/generate/{tournament}', 'App\Http\Controllers\GroupGenerateController@store');

    // GET /api/actions/games/generate
    Route::post('/games/generate/{tournament}', 'App\Http\Controllers\GameGenerateController@store');

    // GET /api/actions/games/resolve
    Route::post('/games/resolve/{tournament}', 'App\Http\Controllers\GameResolveController@store');
});
