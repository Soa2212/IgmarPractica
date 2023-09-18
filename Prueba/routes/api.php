<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\ApiController;
use App\Http\Controllers\api\v2\ApiController as ApiV2Controller;
use App\Http\Controllers\Monitores_Controller;
use App\Http\Controllers\Libros_Controller;
use App\Http\Controllers\VendedorController ;


/* 

Ejemplos vistos en clase

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
*/
Route::prefix('v1')->group(function () {
    Route::post('/Monitores', [Monitores_Controller::class, 'store']);
    Route::get('/Monitores', [Monitores_Controller::class, 'index']);
    Route::put('/Monitores/edit/{id}', [Monitores_Controller::class, 'update'])
        ->where(['id', '[0-9]+']);
    Route::delete('/Monitores/delete/{id}',[Monitores_Controller::class, 'destroy'])
        ->where(['id', '[0-9]+']); 
        
    Route::post('/Libros', [Libros_Controller::class, 'store']);
    Route::get('/Libros', [Libros_Controller::class, 'index']);
    Route::put('/Libros/edit/{id}', [Libros_Controller::class, 'update'])
        ->where(['id', '[0-9]+']);
    Route::delete('/Libros/delete/{id}',[Libros_Controller::class, 'destroy'])
        ->where(['id', '[0-9]+']);    


    Route::post('/vendedores',[VendedorController::class,'store']);
    Route::get('/vendedores',[VendedorController::class,'index']);
    Route::put('/vendedores/actualizar/{id}',[VendedorController::class,'update'])
            ->where('id','[0-9]+');
    Route::delete('/vendedores/delete/{id}',[Libros_Controller::class, 'destroy'])
            ->where(['id', '[0-9]+']);    

});