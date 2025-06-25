<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\AdminClassesController;
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

Route::get('/admin/classes', [AdminClassesController::class, 'index'])
    ->name('admin.classes');

Route::get('/admin/classes/create', [AdminClassesController::class, 'create'])
    ->name('admin.classes.create');

// Route::group(['prefix' => 'admin'], function() {
//     Route::get('/classes', [ClassesFormController::class, 'index'])
//         ->name('admin.classes.create');

    // Route::post('/store', [ClassesController::class, 'store'])
    //     ->name('admin.classes.store');

    // Route::get('/{id}/edit', [ClassesController::class, 'edit'])
    //     ->name('admin.classes.edit');

    // Route::put('/{id}', [ClassesController::class, 'update'])
    //     ->name('admin.classes.update');

    // Route::delete('/{id}', [ClassesController::class, 'destroy'])
    //     ->name('admin.classes.destroy');
// });