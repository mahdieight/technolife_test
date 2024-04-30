<?php

use App\Http\Controllers\API\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'backoffice/orders'], function () {
    Route::get('/', [OrderController::class, 'index']);
});
