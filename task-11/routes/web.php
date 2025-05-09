<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ProfileController;

Route::get('/', [ProfileController::class, 'index']);

Route::get('/profile/{id}', [ProfileController::class, 'show']);
