<?php

use App\Http\Controllers\DepartmentController;
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

//-----------------------------------------------INVENTORY SYSTEM ROUTES............................................
// use Illuminate\Support\Facades\Route;
use App\Http\Controllers\inventory\SubUnitsController;
use App\Http\Controllers\inventory\SuppliersController;
use App\Http\Controllers\inventory\UofMeasureController;
use App\Http\Livewire\Inventory\Dashboards\MainDashboardComponent;
use App\Http\Livewire\Inventory\Manage\CategoryComponent;
use App\Http\Livewire\Inventory\Manage\ItemsComponent;
use App\Http\Livewire\Inventory\Manage\UOMComponent;
use App\Http\Livewire\Inventory\StoresComponent;
use App\Http\Livewire\Manage\SupplierComponent;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'role:InvAdmin|SuperAdmin']], function () {
    Route::group(['prefix' => 'inventory'], function () {
        Route::get('/', MainDashboardComponent::class)->name('inventory');
        Route::get('/store', StoresComponent::class)->name('stores');
        Route::get('/incategories', CategoryComponent::class)->name('invcategories');
        Route::get('/unitOfMeasure', UOMComponent::class)->name('invuom');
        Route::get('/invSuppliers', SupplierComponent::class)->name('invSuppliers');
        Route::get('/invItems', ItemsComponent::class)->name('invItems');

        Route::get('/dashboard', [App\Http\Controllers\inventory\DashboardController::class, 'index']);
        Route::get('/newItem', [App\Http\Controllers\inventory\ItemsController::class, 'create']);
        Route::get('/Items', [App\Http\Controllers\inventory\ItemsController::class, 'index']);
        Route::post('/add-item', [App\Http\Controllers\inventory\ItemsController::class, 'store']);
        Route::get('/edit-item/{id}', [App\Http\Controllers\inventory\ItemsController::class, 'edit']);
        Route::post('/update-item/{id}', [App\Http\Controllers\inventory\ItemsController::class, 'update']);
        Route::get('/getSubUnits', [App\Http\Controllers\inventory\ItemsController::class, 'getSubUnits'])->name('getSubUnits');

        //-------------------Categories routes------------------------------------------------------
        Route::resource('categories', DepartmentController::class);
        Route::get('/delete-unit/{id}', [App\Http\Controllers\DepartmentsController::class, 'destroy']);

        //----------------------------------Subcategories routes---------------------------------------------
        Route::resource('SubCategories', SubUnitsController::class);
        Route::get('/delete-Subunit/{id}', [App\Http\Controllers\inventory\SubUnitsController::class, 'destroy']);

        //----------------------------------UOM routes---------------------------------------------
        Route::resource('uom', UofMeasureController::class);
        Route::get('/delete-uom/{id}', [App\Http\Controllers\inventory\UofMeasureController::class, 'destroy']);

        //----------------------------------supplier routes---------------------------------------------
        Route::resource('suppliers', SuppliersController::class);
        Route::get('/delete-supplier/{id}', [App\Http\Controllers\inventory\SuppliersController::class, 'destroy']);
        //----------------------------------store routes---------------------------------------------
        Route::get('/stores', [App\Http\Controllers\inventory\StoresController::class, 'index']);
        Route::post('/addstore', [App\Http\Controllers\inventory\StoresController::class, 'store']);
        Route::get('/delete-store/{id}', [App\Http\Controllers\inventory\StoresController::class, 'destroy']);
        Route::post('/update-store/{id}', [App\Http\Controllers\inventory\StoresController::class, 'update']);

        //----------------------------------stock routes---------------------------------------------
        Route::get('/stockLevels', [App\Http\Controllers\inventory\StockLevelController::class, 'index']);
        Route::get('/receiveStock/{id}', [App\Http\Controllers\inventory\StockLevelController::class, 'create']);
        Route::post('/add-stock', [App\Http\Controllers\inventory\StockLevelController::class, 'store']);
        Route::get('/delete-stockitem/{id}', [App\Http\Controllers\inventory\StockLevelController::class, 'destroy']);
        Route::get('/delete-stock/{id}', [App\Http\Controllers\inventory\StockLevelController::class, 'destroystock']);
        Route::post('/update-stock/{id}', [App\Http\Controllers\inventory\StockLevelController::class, 'update']);
        Route::get('/getItem', [App\Http\Controllers\inventory\StockLevelController::class, 'getitemData']);
        Route::post('/save-stock', [App\Http\Controllers\inventory\StockLevelController::class, 'saveStock']);
        Route::get('/view-stock/{id}', [App\Http\Controllers\inventory\StockLevelController::class, 'viewstockdetails']);
        Route::get('/confirmedStock', [App\Http\Controllers\inventory\StockLevelController::class, 'confirmed']);
        Route::get('/unconfirmedStock', [App\Http\Controllers\inventory\StockLevelController::class, 'unconfirmed']);

        //----------------------------------department items routes---------------------------------------------
        Route::get('/department/items', [App\Http\Controllers\inventory\DepartmentItemsController::class, 'index']);
        Route::post('/departments/addItems', [App\Http\Controllers\inventory\DepartmentItemsController::class, 'store']);
        Route::get('/departments/items/delete/{id}', [App\Http\Controllers\inventory\DepartmentItemsController::class, 'destroy']);

        //----------------------------------department users routes---------------------------------------------
        Route::get('/department/users', [App\Http\Controllers\inventory\UserDepartmentsController::class, 'index']);
        Route::post('/addDepartmentUsers', [App\Http\Controllers\inventory\UserDepartmentsController::class, 'store']);
        Route::get('/delete-departUser/{id}', [App\Http\Controllers\inventory\UserDepartmentsController::class, 'destroy']);
        Route::post('/update-DepartUser/{id}', [App\Http\Controllers\inventory\UserDepartmentsController::class, 'update']);
    });
});
Route::group(['middleware' => ['auth', 'role:InvUser|InvAdmin'], 'prefix' => 'inventory'], function () {
    //----------------------------------request routes---------------------------------------------
    Route::get('/', MainDashboardComponent::class)->name('inventory');
    // Route::get('/', [App\Http\Controllers\inventory\DashboardController::class, 'index'])->name('inventory');
    Route::get('/request/new', [App\Http\Controllers\inventory\RequestsController::class, 'index']);
    Route::get('/request/lend', [App\Http\Controllers\inventory\RequestsController::class, 'external']);
    Route::post('/request/details', [App\Http\Controllers\inventory\RequestsController::class, 'create']);
    Route::post('/request/details/lend', [App\Http\Controllers\inventory\RequestsController::class, 'create2']);

    Route::get('/request/items/{id}', [App\Http\Controllers\inventory\RequestsController::class, 'requestItems']);
    Route::get('/getRequestItem', [App\Http\Controllers\inventory\RequestsController::class, 'getitemData']);
    Route::post('/request/additem', [App\Http\Controllers\inventory\RequestsController::class, 'store']);
    Route::get('/request/delete-item/{id}/{qty}/{item}', [App\Http\Controllers\inventory\RequestsController::class, 'destroy']);
    Route::post('/request/delete', [App\Http\Controllers\inventory\RequestsController::class, 'destroyRequest']);
    Route::post('/request/update/{id}', [App\Http\Controllers\inventory\RequestsController::class, 'update']);
    Route::get('/request/confirm/{id}', [App\Http\Controllers\inventory\RequestsController::class, 'confirmRequest']);
    Route::get('/getApprover', [App\Http\Controllers\inventory\RequestsController::class, 'getApprover']);
    Route::get('/request/view/{id}', [App\Http\Controllers\inventory\RequestsController::class, 'Viewrequest']);
    Route::get('/requests/draft', [App\Http\Controllers\inventory\RequestsController::class, 'DraftRequests']);
    Route::get('/requests/submitted', [App\Http\Controllers\inventory\RequestsController::class, 'SubmittedRequests']);
    Route::get('/requests/borrowed', [App\Http\Controllers\inventory\RequestsController::class, 'BorrowedRequests']);

    Route::get('/requests/confirm', [App\Http\Controllers\inventory\RequestsController::class, 'ApprovedRequests']);
    Route::get('/requests/approvels/pending', [App\Http\Controllers\inventory\RequestsController::class, 'PendingApprovels']);
    Route::get('/requests/approvels/approved', [App\Http\Controllers\inventory\RequestsController::class, 'ApprovedRequests']);
    Route::get('/request/approve/{id}', [App\Http\Controllers\inventory\RequestsController::class, 'ApproveRequest']);
    Route::post('/request/updateState', [App\Http\Controllers\inventory\RequestsController::class, 'UpdateRequestState']);
    Route::post('/request/acknowledge', [App\Http\Controllers\inventory\RequestsController::class, 'AcknowledgeRequest']);
    Route::post('/request/updateInventoryRequest', [App\Http\Controllers\inventory\RequestsController::class, 'updateInventoryRequest']);
    Route::get('/inv/requests', [App\Http\Controllers\inventory\RequestsController::class, 'InventoryRequests']);
    Route::get('/inv/requests/viewed', [App\Http\Controllers\inventory\RequestsController::class, 'InventoryRequestsViewed']);
    Route::get('/request/inv/view/{id}', [App\Http\Controllers\inventory\RequestsController::class, 'InventorySingleRequest']);

    //----------------------------------report routes---------------------------------------------
    Route::get('/inv/reports', [App\Http\Controllers\inventory\ReportsController::class, 'index']);
    Route::get('/getDptData', [App\Http\Controllers\inventory\ReportsController::class, 'getDptData']);
    Route::get('/getSubDptData', [App\Http\Controllers\inventory\ReportsController::class, 'getSubDptData']);

    //----------------------------------stock status report---------------------------------------------
    Route::post('/report/view/stock', [App\Http\Controllers\inventory\ReportStockStateController::class, 'index']);

    //----------------------------------stock settelment routes---------------------------------------------
    Route::get('/stock/unsettled', [App\Http\Controllers\inventory\StockSettlementController::class, 'index']);
    Route::get('/stock/unsettled/{dpt}/{item}', [App\Http\Controllers\inventory\StockSettlementController::class, 'unsettled']);
    Route::get('/stock/unsettled/recent', [App\Http\Controllers\inventory\StockSettlementController::class, 'recent']);

    //-----------------------------------------------------------------MANAGE INVENTORY------------------------------------------------------------------------

    Route::get('/req/manage', [App\Http\Controllers\inventory\DashboardController::class, 'pickDpt']);
    Route::post('/manage/find', [App\Http\Controllers\inventory\DashboardController::class, 'pathFinder']);
    Route::get('/manage/dashboard', [App\Http\Controllers\inventory\ManageDepartmentController::class, 'index']);
    Route::get('/manage/stockLevels', [App\Http\Controllers\inventory\ManageDepartmentController::class, 'stock']);
    Route::get('/manage/reports', [App\Http\Controllers\inventory\ManageDepartmentController::class, 'reports']);
    Route::get('/manage/getSubDptData', [App\Http\Controllers\inventory\ManageDepartmentController::class, 'getSubDptItems']);
});

//--------------------------------------------END OF INVENTORY SYSTEM ROUTES--------------------------------------------
