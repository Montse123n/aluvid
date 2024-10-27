<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Models\Producto;



Route::get('/admin', [AdminController::class, 'index'])->name('admin');

// Ruta para el catálogo de productos

Route::get('/catalogo', [ProductController::class, 'showCatalog'])->middleware('auth')->name('catalogo');


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/products', [AdminController::class, 'index'])->name('products.index');
    // Otras rutas que solo debe tener el admin
});



Route::get('products', [ProductController::class, 'index'])->name('products.index');
Route::post('products/storeOrUpdate', [ProductController::class, 'storeOrUpdate'])->name('products.storeOrUpdate');
Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');


Route::get('/', function () {
    return view('welcome');
});

Route::resource('products', ProductController::class);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');

// Ruta para manejar el inicio de sesión
Route::post('login', [LoginController::class, 'login']);



require __DIR__.'/auth.php';
