<?php

use App\Http\Controllers\PetController;
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

Route::get('/', function () {
    return redirect('/pets');
});

Route::get('/pets', [PetController::class, 'index'])->name('pets.index');
Route::get('/pets/create', [PetController::class, 'create'])->name('pets.create');
Route::post('/pets', [PetController::class, 'store'])->name('pets.store');
Route::get('/pets/{petId}/edit', [PetController::class, 'edit'])->name('pets.edit');
Route::post('/pets/{petId}', [PetController::class, 'update'])->name('pets.update');
Route::delete('/pets/{petId}', [PetController::class, 'destroy'])->name('pets.destroy');
Route::get('/pets/{petId}', [PetController::class, 'show'])->name('pets.show');




