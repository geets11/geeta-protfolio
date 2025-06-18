<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// GitHub webhook endpoint (optional for future use)
Route::post('/github/webhook', function (Request $request) {
    // Handle GitHub webhooks for automatic portfolio updates
    return response()->json(['status' => 'success']);
});
