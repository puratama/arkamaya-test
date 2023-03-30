<?php

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
    return view('index');
});

// WITH API
Route::get('/clients', function() {
    return view('pages.client.indexApi');
});
Route::get('/projects/api', function() {
    return view('pages.project.indexApi');
});

// WITHOUT API
Route::get('/projects', [App\Http\Controllers\ProjectController::class, 'index']);
Route::get('/project/filter', [App\Http\Controllers\ProjectController::class, 'filter']);
Route::post('/project/store', [App\Http\Controllers\ProjectController::class, 'store']);
Route::post('/project/update', [App\Http\Controllers\ProjectController::class, 'update']);
Route::get('/project/delete/{id}', [App\Http\Controllers\ProjectController::class, 'delete']);