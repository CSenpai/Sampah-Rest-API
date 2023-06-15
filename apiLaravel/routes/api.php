<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SampahController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/sampah', [SampahController::class, 'index']);
Route::post('/sampah/store', [SampahController::class, 'store']);
Route::patch('/sampah/{id}/update', [SampahController::class, 'update']);
Route::delete('/sampah/{id}/delete', [SampahController::class, 'destroy']);
Route::get('/sampah/show/trash', [SampahController::class, 'trash']);
Route::get('/sampah/trash/delete/permanent/{id}', [SampahController::class, 'permanentDelete']);