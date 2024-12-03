<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SectorController;

// Proteger rutas de sectores con middleware 'auth'
Route::middleware(['auth'])->group(function () {
    Route::get('/sectores', [SectorController::class, 'index'])->name('sectores.index');
    Route::get('/sectores/{sector}', [SectorController::class, 'show'])->name('sectores.show');
});


Route::get('/sectores', [ProductoController::class, 'sectores'])->name('productos.sectores');

Route::get('/', function () {
    return view('welcome');
})->name('welcome');


Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::get('/sectores', [AdminProductController::class, 'showSectores'])->name('productos.sectores');

// Rutas del perfil de usuario
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

use App\Http\Controllers\HomeController;

Auth::routes();

// Rutas para usuarios (carpeta productos)


// Rutas para usuarios con rol "usuario"
Route::middleware(['auth', RoleMiddleware::class . ':usuario'])->group(function () {
    Route::get('/sectores', [ProductController::class, 'showSectores'])->name('productos.sectores');
    Route::get('/tipos/{sectorId}', [ProductController::class, 'showTipos'])->name('sector.tipos');
    Route::get('/tipos/{tipoId}/productos', [ProductController::class, 'showProductos'])->name('tipo.productos');
    Route::view('/productos', 'productos.productos');
    Route::view('/cotizaciones', 'productos.cotizaciones');
    Route::get('/tipos/{tipoId}/productos', [ProductController::class, 'showProductos'])->name('tipo.productos');

});

// Rutas para administradores con rol "administrador"
use App\Http\Controllers\AdminProductController;

// Rutas exclusivas para administradores
Route::middleware(['auth', RoleMiddleware::class . ':administrador'])->group(function () {
    Route::get('/admin', [AdminProductController::class, 'index'])->name('admin.index'); // Página principal del administrador
    Route::get('/admin/perfiles', [AdminProductController::class, 'perfiles'])->name('admin.perfiles'); // Gestión de trabajadores
    Route::get('/admin/tipos/{sectorId}/create', [AdminProductController::class, 'createTipo'])->name('admin.createTipo');
    Route::post('/admin/crear-tipo', [AdminProductController::class, 'storeTipo'])->name('admin.crear_tipo');
    Route::post('/admin/tipos/{sectorId}/store', [AdminProductController::class, 'storeTipo'])->name('admin.storeTipo');
    Route::get('/admin/tipos/{sectorId}', [AdminProductController::class, 'showTipos'])->name('admin.showTipos');
    Route::get('/admin/tipos/{tipoId}/edit', [AdminProductController::class, 'editTipo'])->name('admin.editTipo');
    Route::put('/admin/tipos/{tipoId}', [AdminProductController::class, 'updateTipo'])->name('admin.updateTipo');
    Route::delete('/admin/tipos/{tipoId}', [AdminProductController::class, 'destroyTipo'])->name('admin.destroyTipo');
    Route::get('/admin/productos/{tipoId}', [AdminProductController::class, 'showProductos'])->name('admin.showProductos');
    Route::get('/admin/tipos/{tipoId}/productos/create', [AdminProductController::class, 'createProducto'])->name('admin.createProducto');
    Route::post('/admin/tipos/{tipoId}/productos', [AdminProductController::class, 'storeProducto'])->name('admin.storeProducto');  
    Route::get('/admin/productos/{id}/edit', [AdminProductController::class, 'editProducto'])->name('admin.editProducto');
    Route::put('/admin/productos/{id}', [AdminProductController::class, 'updateProducto'])->name('admin.updateProducto');
    Route::delete('/admin/delete-producto/{producto}', [AdminProductController::class, 'destroyProducto'])->name('admin.destroyProducto');
    Route::get('/admin/productos/{productoId}/subproductos', [AdminProductController::class, 'showSubproductos'])->name('admin.showSubproductos');
    Route::get('/admin/productos/{productoId}/subproductos/create', [AdminProductController::class, 'createSubproducto'])->name('admin.createSubproducto');
    Route::post('/admin/productos/{productoId}/subproductos', [AdminProductController::class, 'storeSubproducto'])->name('admin.storeSubproducto');
    Route::get('/admin/subproductos/{id}/edit', [AdminProductController::class, 'editSubproducto'])->name('admin.editSubproducto');
    Route::put('/admin/subproductos/{id}', [AdminProductController::class, 'updateSubproducto'])->name('admin.updateSubproducto');
    Route::delete('/admin/subproductos/{id}', [AdminProductController::class, 'destroySubproducto'])->name('admin.destroySubproducto');
});

use App\Http\Controllers\CotizacionController;

// Rutas de cotizaciones
Route::middleware(['auth', 'verified'])->group(function () {

Route::get('/cotizaciones/vidrio', [CotizacionController::class, 'index'])->name('cotizaciones.vidrio'); // Para mostrar la vista
Route::post('/cotizaciones/vidrio', [CotizacionController::class, 'calcular'])->name('cotizaciones.calcular'); // Para procesar el formulario
Route::get('/tipos/{sectorId}', [CotizacionController::class, 'showSector'])->name('sector.tipos');
Route::post('/cotizacion/calcular', [CotizacionController::class, 'calcularCotizacion'])->name('cotizaciones.calcular');

});

require __DIR__ . '/auth.php';

Auth::routes();


