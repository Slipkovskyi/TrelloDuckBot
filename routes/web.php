<?php

use App\Http\Controllers\TrelloController;
use Illuminate\Support\Facades\Route;

Route::post('send-update-cards', [TrelloController::class, 'sendUpdateCards'])->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);
