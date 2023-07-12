<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome');
});

Route::get('/produits', [ProductController::class, 'index'])->name('products.index');

Route::get('/a-propos', function () {
    return Inertia::render('About');
})->name('about');

Route::middleware('auth')->group(function () {
    Route::get('/mon-compte', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/mon-compte', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/mon-compte', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
