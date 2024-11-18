<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// Página principal
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Dashboard para usuarios logueados
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutas del perfil de usuario
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Autenticación: Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Registro (solo para usuarios normales)
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Rutas exclusivas para Administradores y Trabajadores
Route::middleware(['auth', 'role:administrador,trabajador'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/tipos', [AdminController::class, 'tipos'])->name('admin.tipos');
    Route::get('/admin/productos', [AdminController::class, 'productos'])->name('admin.productos');
    Route::get('/admin/crear-tipo', [AdminController::class, 'crearTipo'])->name('admin.crear_tipo');
    Route::get('/admin/crear-producto', [AdminController::class, 'crearProducto'])->name('admin.crear_producto');
});

// Rutas exclusivas para Administradores
Route::middleware(['auth', 'role:administrador'])->group(function () {
    Route::get('/admin/perfiles', [AdminController::class, 'perfiles'])->name('admin.perfiles');
});

// Incluye las rutas de autenticación
require __DIR__ . '/auth.php';
