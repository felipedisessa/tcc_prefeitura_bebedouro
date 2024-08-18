<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use App\Http\Controllers\NoticiasController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'editProfile'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/noticias/gerenciar', [NoticiasController::class, 'index'])->name('noticias.index');
    Route::post('/noticias', [NoticiasController::class, 'store'])->name('noticias.store');
    Route::resource('/users' , ProfileController::class);
    Route::patch('/users/{user}', [ProfileController::class, 'updateUser'])->name('users.updateUser');

    Route::resource('/noticias' , NoticiasController::class);
    Route::delete('/users/{user}', [ProfileController::class, 'destroyUser'])->name('users.destroyUser');

});

Route::get("/noticias", [NoticiasController::class, "ApiIndex"]); // Rota API para listar todas as notícias


require __DIR__.'/auth.php';
