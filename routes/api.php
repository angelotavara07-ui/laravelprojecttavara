<?php

use App\Http\Controllers\Api\AlumnoController;
use App\Http\Controllers\Api\ProfesorController;
use App\Http\Controllers\Api\CursoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('alumnos', AlumnoController::class);
Route::apiResource('profesores', ProfesorController::class);
Route::apiResource('cursos', CursoController::class);