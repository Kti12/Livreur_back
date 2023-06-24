<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LivreurController;
use App\Http\Controllers\AdminController;
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

Route::get('/index', [ProductController::class, 'index'])->name('index');

Route::get('/produit/principal', [ProductController::class, 'principal'])->name('principal');
Route::get('/produit/create', [ProductController::class, 'create'])->name('produit.create');
Route::post('/produit/principal', [ProductController::class, 'store'])->name('produit.store');
Route::get('/produit/edit/{id}', [ProductController::class, 'edit'])->name('produit.edit');
Route::put('/produit/edit/traitement', [ProductController::class, 'update'])->name('produit.update');
Route::delete('/produit/{id}', [ProductController::class, 'destroy'])->name('produit.destroy');


Route::get('/index', [AdminController::class, 'dashboard'])->name('admin.index');
Route::delete('/index/{id}', [AdminController::class, 'supprimeLivreur'])->name('supprime');

Route::get('/index', [AdminController::class, 'index'])->name('client.index');
Route::delete('/index/{id}', [AdminController::class, 'supprimerclient'])->name('client.supprimer');

Route::get('/livreurs', [LivreurController::class, 'afficherLivreurs'])->name('livreurs.index');
Route::delete('/livreurs/{id}', [LivreurController::class, 'supprimerLivreur'])->name('livreurs.supprimer');
Route::put('/livreurs/{id}/approve', [LivreurController::class, 'approveDriverRegistration'])->name('drivers.approve');



