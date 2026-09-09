<?php

use App\Http\Controllers\Api\BusinessHourController;
use App\Http\Controllers\Api\BuyerInquiryController;
use App\Http\Controllers\Api\CertificationController;
use App\Http\Controllers\Api\ContactOfficeController;
use App\Http\Controllers\Api\EqwoolsHeroController;
use App\Http\Controllers\Api\EqwoolsProductApplicationController;
use App\Http\Controllers\Api\FactoryHeroController;
use App\Http\Controllers\Api\FactoryPartnerController;
use App\Http\Controllers\Api\FooterSettingController;
use App\Http\Controllers\Api\GarmentAccessoryCategoryController;
use App\Http\Controllers\Api\HeroSlideController;
use App\Http\Controllers\Api\JobApplicationController;
use App\Http\Controllers\Api\JobController;
use App\Http\Controllers\Api\LeaderController;
use App\Http\Controllers\Api\NewsArticleController;
use App\Http\Controllers\Api\ProductCategoryController;
use App\Http\Controllers\Api\ProductHeroController;
use App\Http\Controllers\Api\PurposeSectionController;
use App\Http\Controllers\Api\ShowroomProductController;
use App\Http\Controllers\Api\SiteSettingController;
use App\Http\Controllers\Api\TestimonialController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/site-settings', [SiteSettingController::class, 'show']);
Route::get('/hero-slides', [HeroSlideController::class, 'index']);
Route::get('/footer',[FooterSettingController::class,'show',]);
Route::get('/purpose-section', [PurposeSectionController::class, 'show']);

//about us
Route::get('/leaders', [LeaderController::class, 'index']);

//careers
Route::prefix('jobs')->group(function () {
    Route::get('/', [JobController::class, 'index']);
    Route::get('/featured', [JobController::class, 'featured']);
    Route::get('/{job}', [JobController::class, 'show']);
    Route::post('/{job}/apply', [JobApplicationController::class, 'store'])->middleware('throttle:10,1');
});

//news-articles
Route::prefix('news')->group(function () {
    Route::get('/', [NewsArticleController::class, 'index']);
    Route::get('/featured',[NewsArticleController::class,'featured']);
    Route::get('/{newsArticle}',[NewsArticleController::class,'show']);
});

//product-categories
Route::get('/product-categories',[ProductCategoryController::class, 'index']);
Route::get('/product-hero',[ProductHeroController::class, 'show']);

//factory-matrix
Route::get('/factory-partners',[FactoryPartnerController::class, 'index']);
Route::get('/factory-hero',[FactoryHeroController::class, 'show']);

//innovation-hub
Route::get('/showroom-products',[ShowroomProductController::class, 'index']);
Route::get('/showroom-products/{slug}',[ShowroomProductController::class, 'show']);
Route::post('/buyer-inquiries',[BuyerInquiryController::class, 'store'])->middleware('throttle:10,1');

//sustainability
Route::get('/certifications', [CertificationController::class, 'index']);

//eqwools-product-applications
Route::get('/eqwools-product-applications',[ EqwoolsProductApplicationController::class,'index',]);
    Route::get('/eqwools-hero',[EqwoolsHeroController::class,'show',]);

    //garment-accessory-categories
Route::get('/garment-accessory-categories',[GarmentAccessoryCategoryController::class,'index',]);

//contact-offices
Route::get('/contact-offices',[ ContactOfficeController::class,'index',]);
Route::get('/business-hours',[BusinessHourController::class, 'show']);


Route::get('/testimonials',[TestimonialController::class, 'index']);

