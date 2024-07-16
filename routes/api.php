<?php

use App\Http\Controllers\Example\ExampleGetController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Currencies\GetCurrenciesController;
use App\Http\Controllers\Currencies\GetRateConversionCurrenciesController;


Route::get('/example', ExampleGetController::class);
Route::get('/currencies', GetCurrenciesController::class);
Route::get('/currencies/rate-conversion', GetRateConversionCurrenciesController::class);
