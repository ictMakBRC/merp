<?php

use App\Http\Livewire\DocumentManagement\DocumentCategoryComponent;
use App\Http\Livewire\DocumentManagement\DocumentDashboardComponent;
use App\Http\Livewire\DocumentManagement\NewDocumentComponent;
use App\Http\Livewire\DocumentManagement\PreviewDocumentComponent;
// Route::get('/dashboard', function () {
//     return view('dashboard');    
// })->middleware(['auth'])->name('dashboard');

//-----------------------------------------------INVENTORY SYSTEM ROUTES............................................
// use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'documents'], function () {      
        //----------------------------------document routes---------------------------------------------      
        Route::get('/dashboard', DocumentDashboardComponent::class)->name('document.dashboard');
        Route::get('/categories', DocumentCategoryComponent::class)->name('document.categories');
        Route::get('/request/{code}/preview', PreviewDocumentComponent::class)->name('document.preview');
        Route::get('/request/new', NewDocumentComponent::class)->name('document.request');
    });
});

//--------------------------------------------END OF INVENTORY SYSTEM ROUTES--------------------------------------------
