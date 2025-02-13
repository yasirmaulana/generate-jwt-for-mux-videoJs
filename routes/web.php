<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JwtController;

Route::get('/', function () {
    return view('welcome');
});