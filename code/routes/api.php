<?php

use App\Http\Controllers\Api\V1\Scores\ImportController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::post('/scores/import', ImportController::class);
});