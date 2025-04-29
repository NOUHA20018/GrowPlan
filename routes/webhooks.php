<?php

use Illuminate\Support\Facades\Route;

Route::get('/send', function () {
    return response()->json(['message' => 'Webhook received']);
})->name('send');
