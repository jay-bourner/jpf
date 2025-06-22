<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])
    ->name('home.index');

Route::get('/classes', [ClassesController::class, 'index'])
    ->name('classes.index');

Route::get('/contact', [ContactController::class, 'index'])
    ->name('contact.index');
    
Route::post('/contact/submit', [ContactController::class, 'submit'])
    ->name('contact.submit');

Route::get('/admin', [AdminController::class, 'index'])
    ->name('admin.index');