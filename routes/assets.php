<?php

use App\Http\Controllers\asset\AssetCategoryController;
use App\Http\Controllers\asset\AssetController;
use App\Http\Controllers\asset\AssetInsuranceTypeController;
use App\Http\Controllers\asset\AssetIssueController;
use App\Http\Controllers\asset\AssetMaintenanceController;
use App\Http\Controllers\asset\AssetSubcategoryController;
use App\Http\Controllers\asset\AssetVendorController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\StationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['prefix' => 'asset', 'middleware' => ['auth']], function () {
    //-------------------------------CATEGORIES MANAGEMENT ROUTES------------------------
    Route::resource('categories', AssetCategoryController::class);

    Route::group(['prefix' => 'category'], function () {
        Route::resource('subcategories', AssetSubcategoryController::class);
    });

    //-------------------------------VENDORS MANAGEMENT ROUTES------------------------
    Route::resource('vendors', AssetVendorController::class);

    //-------------------------------ASSET STATIONS MANAGEMENT ROUTES------------------------
    Route::resource('stations', StationController::class);

    //-------------------------------DEPARTMENTS MANAGEMENT ROUTES------------------------

    Route::resource('departments', DepartmentController::class);

    //-------------------------------ASSET INSURANCE TYPES ROUTES------------------------
    Route::resource('insurancetypes', AssetInsuranceTypeController::class);

    //-------------------------------ISSUES MANAGEMENT ROUTES------------------------
    Route::resource('issues', AssetIssueController::class);

    //-------------------------------MAINTENANCE MANAGEMENT ROUTES------------------------
    Route::resource('maintenance', AssetMaintenanceController::class);
});
//-------------------------------ASSET MANAGEMENT ROUTES------------------------

Route::group(['middleware' => ['auth']], function () {
    Route::get('asset/export', [AssetController::class, 'export'])->name('asset.export');
    Route::get('asset/barcodes', [AssetController::class, 'barcodes'])->name('barcodes.show');
    Route::get('asset/search', [AssetController::class, 'searchAsset'])->name('asset_search.show');
    Route::get('asset/search/action', [AssetController::class, 'searchAction'])->name('asset_search.action');
    Route::get('asset/detail/{id}', [AssetController::class, 'showDetail'])->name('asset.detail');
    Route::resource('asset', AssetController::class);
});
