<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Login route
Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');

    if (auth()->attempt($credentials)) {
        $user = auth()->user();
        return response()->json([
            'success' => true,
            'user' => $user,
            'token' => $user->createToken('API Token')->plainTextToken,
        ]);
    }

    return response()->json(['success' => false, 'message' => 'Invalid credentials'], 401);
});

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'apiDashboard']);
    Route::get('/penduduk', [App\Http\Controllers\PendudukController::class, 'apiIndex']);
    Route::get('/intervensi', [App\Http\Controllers\TindakanIntervensiController::class, 'apiIndex']);
    Route::get('/users', [App\Http\Controllers\UserController::class, 'apiIndex']);
});
