<?php

use Illuminate\Support\Facades\Route;

Route::post('/applications', [\App\Http\Controllers\ApplicationController::class, 'store']);

Route::get('/test', function () {
    return response()->json(['message' => 'API is working']);
});
