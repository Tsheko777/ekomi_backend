<?php

use App\Http\Controllers\OutlookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/contact/{email}', [OutlookController::class, 'getContacts'])
    ->middleware(['auth:sanctum']);

require __DIR__ . '/auth.php';