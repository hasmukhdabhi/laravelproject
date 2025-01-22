<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\PostController;
// use illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use PHPUnit\Framework\Attributes\PostCondition;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// 21/01/2025
// Route::get('/user/{id}', [UserController::class, 'show']);

// Route::get('/users', [UserController::class, 'index']);

// Route::resource('photos', PhotoController::class);
// Route::resources([
//     'photos' => PhotoController::class,
//     'posts' => PostController::class,
// ]);
// 21/01/2025

