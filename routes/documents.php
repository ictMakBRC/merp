<?php

use App\Http\Livewire\DocumentManagement\DocumentCategoryComponent;
use App\Http\Livewire\DocumentManagement\DocumentDashboardComponent;
use App\Http\Livewire\DocumentManagement\DocumentResourcesComponent;
use App\Http\Livewire\DocumentManagement\IncomingDocumentRequestsComponent;
use App\Http\Livewire\DocumentManagement\NewDocumentComponent;
use App\Http\Livewire\DocumentManagement\PreviewDocumentComponent;
use App\Http\Livewire\DocumentManagement\RecentDocumentsComponent;
use App\Http\Livewire\DocumentManagement\SignDocumentsComponent;
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
        Route::get('/request/{request_code}/sign', SignDocumentsComponent::class)->name('document.sign');
        Route::get('/my_requests', NewDocumentComponent::class)->name('document.request');
        Route::get('/requests/incoming', IncomingDocumentRequestsComponent::class)->name('document.incoming');
        Route::get('/requests/documents', RecentDocumentsComponent::class)->name('document.documents');


        Route::get('/document/resources', DocumentResourcesComponent::class)->name('document.resources');
    });
});

//--------------------------------------------END OF INVENTORY SYSTEM ROUTES--------------------------------------------
