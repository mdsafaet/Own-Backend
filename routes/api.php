<?php

use App\Http\Controllers\Api\HeroSlideController;
use App\Http\Controllers\Api\JobApplicationController;
use App\Http\Controllers\Api\JobController;
use App\Http\Controllers\Api\LeaderController;
use App\Http\Controllers\Api\PurposeSectionController;
use App\Http\Controllers\Api\SiteSettingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/site-settings',[SiteSettingController::class, 'show']);
Route::get('/hero-slides',[HeroSlideController::class, 'index']);
Route::get('/purpose-section',[PurposeSectionController::class, 'show']);

//about us
Route::get('/leaders', [LeaderController::class, 'index']);

//careers
Route::prefix('jobs')->group(function () {
    Route::get('/',[JobController::class, 'index']);
    Route::get('/featured',[JobController::class, 'featured']);
    Route::get('/{job}',[JobController::class, 'show']);
    Route::post('/{job}/apply',[JobApplicationController::class, 'store'])->middleware('throttle:10,1');
});