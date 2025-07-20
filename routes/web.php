<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminClassesController;
use App\Http\Controllers\Admin\AdminPricesController;
use App\Http\Controllers\Admin\AdminSettingsController;
use App\Http\Controllers\Admin\AdminVenuesController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\ContactController;
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

Route::group(['prefix' => 'classes'], function() {
    Route::get('/', [ClassesController::class, 'index'])
        ->name('classes.index');
    Route::get('/{slug}', [ClassesController::class, 'show'])
        ->name('classes.show');
});

Route::group(['prefix' => 'contact'], function() {
    Route::get('/', [ContactController::class, 'index'])
        ->name('contact.index');
    Route::post('/submit', [ContactController::class, 'submit'])
        ->name('contact.submit');
});

Route::group(['prefix' => 'admin'], function() {
    Route::get('/', [AdminController::class, 'index'])
        ->name('admin.index');

    Route::get('/classes', [AdminClassesController::class, 'index'])
        ->name('admin.classes');

    Route::get('/venues', [AdminVenuesController::class, 'index'])
        ->name('admin.venues');
        
    Route::get('/prices', [AdminPricesController::class, 'index'])
        ->name('admin.prices');
        
    Route::get('/settings', [AdminSettingsController::class, 'index'])
        ->name('admin.settings');
});