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
    Route::get('/noticias/gerenciar', [NoticiasController::class, 'index'])->name('noticias.index');
    Route::post('/noticias', [NoticiasController::class, 'store'])->name('noticias.store');
    Route::patch('/users/{user}', [ProfileController::class, 'updateUser'])->name('users.updateUser');
    Route::resource('/users' , ProfileController::class);


    Route::resource('/noticias' , NoticiasController::class);
    Route::delete('/users/{user}', [ProfileController::class, 'destroyUser'])->name('users.destroyUser');
    Route::post('/users/restore/{id}', [ProfileController::class, 'restore'])->name('users.restore');

});

Route::get("/noticias", [NoticiasController::class, "ApiIndex"]); // Rota API para listar todas as notícias
Route::get('/image/{path}', function ($path) {
    $path = storage_path('app/public/' . $path);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = response($file, 200)->header("Content-Type", $type);
    $response->header('Access-Control-Allow-Origin', '*');
    $response->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
    $response->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');

    return $response;
})->where('path', '.*');

require __DIR__.'/auth.php';
