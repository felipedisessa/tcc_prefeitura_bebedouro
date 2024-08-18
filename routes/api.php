<?php

use App\Http\Controllers\NoticiasController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get("noticias", [NoticiasController::class, "index"]);