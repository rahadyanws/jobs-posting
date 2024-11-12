<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/vacancies', App\Http\Controllers\Api\VacancyController::class);
Route::post('/applies', 'App\Http\Controllers\Api\ApplyController@store');
