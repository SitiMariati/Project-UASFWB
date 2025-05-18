<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\JadwalTayangController;

Route::get('/', function () {
    return view('welcome');
});
Route::resource('film', FilmController::class);
Route::resource('jadwal_tayang',JadwalTayangController::class);