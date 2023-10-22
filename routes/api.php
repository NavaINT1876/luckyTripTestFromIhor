<?php

use App\Http\Controllers\AirportController;
use Illuminate\Support\Facades\Route;


Route::get('/airports/{airportId}', [AirportController::class, 'view'])->where('id', '[0-9]+');

Route::post('/airports', [AirportController::class, 'create']);

Route::put('/airports/{airportId}', [AirportController::class, 'edit'])->where('id', '[0-9]+');

Route::delete('/airports/{airportId}', [AirportController::class, 'delete'])->where('id', '[0-9]+');

Route::get('/airports', [AirportController::class, 'list']);
