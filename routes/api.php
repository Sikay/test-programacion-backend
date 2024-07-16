<?php

use App\Http\Controllers\Example\ExampleGetController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Currencies\GetCurrenciesController;


Route::get('/example', ExampleGetController::class);
Route::get('/currencies', GetCurrenciesController::class);
