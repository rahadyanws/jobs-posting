<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', App\Http\Controllers\Api\RegisterController::class)->name('register');

Route::post('/login', App\Http\Controllers\Api\LoginController::class)->name('login');

Route::post('/logout', App\Http\Controllers\Api\LogoutController::class)->name('logout');

Route::get('/vacancies', 'App\Http\Controllers\Api\VacancyController@index');
Route::get('/vacancies/{vacancy_id}', 'App\Http\Controllers\Api\VacancyController@show');

Route::post('/applies', 'App\Http\Controllers\Api\ApplyController@store');
Route::middleware('auth:api')->group(function () {
    Route::post('/vacancies', 'App\Http\Controllers\Api\VacancyController@store');
    Route::put('/vacancies/{vacancy_id}', 'App\Http\Controllers\Api\VacancyController@update');

    Route::put('/applies/{apply_id}', 'App\Http\Controllers\Api\ApplyController@update');
    Route::get('/applies/candidates/{vacancy_id}', 'App\Http\Controllers\Api\ApplyController@showAllCandidateByVacancyId');
    Route::get('/applies/vacancies/{candidate_id}', 'App\Http\Controllers\Api\ApplyController@showAllVacancyByCandidateId');
});