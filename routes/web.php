<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Controllers\FilmController;
use App\Http\Controllers\JadwalTayangController;
use App\Models\Pengguna;

// Home Page
Route::get('/', function () {
    return view('welcome');
});
