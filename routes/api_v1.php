<?php

use App\Http\Controllers\Api\V1\CountryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('api_version:1.0')->group(function () {

    Route::get('countries/youtube/{country_id}', [CountryController::class, 'getYoutubeVideo'])->name('countries.get.video');
    Route::get('countries/wikipedia/{country_id}', [CountryController::class, 'getWikiText'])->name('countries.get.text');
});
