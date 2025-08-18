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

    // Classes Routes
    Route::get('/classes', [AdminClassesController::class, 'index'])
        ->name('admin.classes');

    Route::get('/classes/create', [AdminClassesController::class, 'create'])
        ->name('admin.classes.create');

    Route::get('/classes/edit/{id}', [AdminClassesController::class, 'edit'])
        ->name('admin.classes.edit');

    Route::get('/classes/view/{id}', [AdminClassesController::class, 'view'])
        ->name('admin.classes.view');

    Route::post('/classes/store', [AdminClassesController::class, 'store'])
        ->name('admin.classes.store');

    Route::put('/classes/update/{id}', [AdminClassesController::class, 'update'])
        ->name('admin.classes.update');

    Route::get('/classes/delete/{id}', [AdminClassesController::class, 'destroy'])
        ->name('admin.classes.delete');


    // venues routes
    Route::get('/venues', [AdminVenuesController::class, 'index'])
        ->name('admin.venues');

    Route::get('/venues/create', [AdminVenuesController::class, 'create'])
        ->name('admin.venues.create');

    Route::post('/venues/store', [AdminVenuesController::class, 'store'])
        ->name('admin.venues.store');

    Route::get('/venues/edit/{id}', [AdminVenuesController::class, 'edit'])
        ->name('admin.venues.edit');

    Route::get('/venues/view/{id}', [AdminVenuesController::class, 'view'])
        ->name('admin.venues.view');

    Route::put('/venues/update/{id}', [AdminVenuesController::class, 'update'])
        ->name('admin.venues.update');

    Route::get('/venues/delete/{id}', [AdminVenuesController::class, 'destroy'])
        ->name('admin.venues.delete');


    // prices routes
    Route::get('/prices', [AdminPricesController::class, 'index'])
        ->name('admin.prices');

    Route::get('/prices/create', [AdminPricesController::class, 'create'])
        ->name('admin.prices.create');

    Route::post('/prices/store', [AdminPricesController::class, 'store'])
        ->name('admin.prices.store');

    Route::get('/prices/edit/{id}', [AdminPricesController::class, 'edit'])
        ->name('admin.prices.edit');

    Route::get('/prices/view/{id}', [AdminPricesController::class, 'view'])
        ->name('admin.prices.view');

    Route::put('/prices/update/{id}', [AdminPricesController::class, 'update'])
        ->name('admin.prices.update');

    Route::get('/prices/delete/{id}', [AdminPricesController::class, 'destroy'])
        ->name('admin.prices.delete');

    // settings routes
    Route::get('/settings', [AdminSettingsController::class, 'index'])
        ->name('admin.settings');
});


// API routes
Route::group(['prefix' => 'api'], function () {
    Route::get('/venues', [AdminVenuesController::class, 'apiIndex']);
    Route::get('/classes', [AdminClassesController::class, 'apiIndex']);
});

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
