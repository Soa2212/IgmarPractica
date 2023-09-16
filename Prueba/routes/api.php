<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\ApiController;
use App\Http\Controllers\api\v2\ApiController as ApiV2Controller;
use App\Http\Controllers\Monitores_Controller;

Route::prefix('v1')->group(function () {
    Route::get('/welcome/{numero}/{numero2?}', [ApiController::class, 'index'])
        ->where(['numero', '[0-9]+', 'numero2', '[0-9]+'])
        ->name('get.v1.welcome');
});

Route::prefix('v2')->group(function () {
    Route::post('/personas', [ApiV2Controller::class, 'store']);
    Route::get('/personas', [ApiV2Controller::class, 'index']);
    Route::put('/personas/edit/{id}', [ApiV2Controller::class, 'update'])
        ->where(['id', '[0-9]+']);
});

Route::prefix('v1')->group(function () {
    Route::post('/Monitores', [Monitores_Controller::class, 'store']);
    Route::get('/Monitores', [Monitores_Controller::class, 'index']);
    Route::put('/Monitores/edit/{id}', [Monitores_Controller::class, 'update'])
        ->where(['id', '[0-9]+']);
});