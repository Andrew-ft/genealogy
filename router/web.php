<?php

use CustomRouter\Route;
use App\Http\Controllers\Pages\PagesController;

require __DIR__ . "/../vendor/autoload.php";

// Landing page
Route::get('/', [PagesController::class, 'landingPage']);