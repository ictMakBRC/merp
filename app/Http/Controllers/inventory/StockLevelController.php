<?php

namespace App\Http\Controllers\inventory;

use App\Http\Controllers\Controller;
use App\Models\inventory\inv_department_Item;
use App\Models\inventory\invItems;
use App\Models\inventory\invStocklevel;
use App\Models\inventory\invStores;
use App\Models\inventory\invSuppliers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $values = inv_department_Item::leftJoin('inv_items', 'inv_department__items.inv_item_id', '=', 'inv_items.id')
        ->leftJoin('departments', 'inv_department__items.department_id', '=', 'departments.id')
        ->leftJoin('inv_subunits', 'inv_items.inv_subunit_id', '=', 'inv_subunits.id')
        ->leftJoin('inv_uoms', 'inv_items.inv_uom_id', '=', 'inv_uoms.id')
        ->select('*', 'inv_items.id as item_id', 'departments.id as dptId')
        ->get();

        return view('inventdashboard.stocklevels', compact('values'));
    }

    public function unconfirmed()
    {
        // $values= invStocklevel::select(DB::raw('sum(total_cost) as totalAmt'))
        // ->where('inv_stocklevels.is_active', 0)
        // ->groupBy('inv_stocklevels.stock_code')
        // ->get();

        $options = ['edit' => '', 'delete' => '', 'view' => 'display:none'];
        $delete = '';
        $edit = '';
        $view = 'display:none';
        DB::statement("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));");
        $values = invStocklevel::leftJoin('users', 'inv_stocklevels.user_id', '=', 'users.id')
        ->groupBy('stock_code')->select('*', DB::raw('count(stock_code) as totalAmt'))
        ->where('inv_stocklevels.is_active', 0)->get();
        DB::statement("SET sql_mode=(SELECT CONCAT(@@sql_mode, ',ONLY_FULL_GROUP_BY'));");

        return view('inventdashboard.stockState', compact('values', 'delete', 'edit', 'view'));
    }

    public function confirmed()
    {
        $options = ['edit' => 'display:none', 'delete' => 'display:none', 'view' => ''];
        $delete = 'display:none';
        $edit = 'display:none';
        $view = '';
        DB::statement("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));");
        $values = invStocklevel::leftJoin('users', 'inv_stocklevels.user_id', '=', 'users.id')
        ->groupBy('stock_code')->select('*', DB::raw('count(stock_code) as totalAmt'))
        ->where('inv_stocklevels.is_active', 1)->get();
        DB::statement("SET sql_mode=(SELECT CONCAT(@@sql_mode, ',ONLY_FULL_GROUP_BY'));");
        // $values=  DB::table('inv_stocklevels')->select('stock_code', DB::raw( 'sum(total_cost) as totalAmt'),DB::raw( 'max(date_added) as date'))
        // ->groupBy('stock_code')
        // ->get();

        return view('inventdashboard.stockState', compact('values', 'delete', 'edit', 'view'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {
        $code = $request->route('id'); //getting the request code
        $stores = invStores::orderBy('store_name', 'asc')->get();
        $suppliers = invSuppliers::orderBy('sup_name', 'asc')->get(); //getting all suppliers
        $items = inv_department_Item::leftJoin('inv_items', 'inv_department__items.inv_item_id', '=', 'inv_items.id')
        ->leftJoin('departments', 'inv_department__items.department_id', '=', 'departments.id')
        ->leftJoin('inv_subunits', 'inv_items.inv_subunit_id', '=', 'inv_subunits.id')
        ->leftJoin('inv_uoms', 'inv_items.inv_uom_id', '=', 'inv_uoms.id')
        ->select('*', 'inv_department__items.id as item_id')
        ->get(); //getting items in the dropdown

        $values = invStocklevel::leftJoin('inv_department__items', 'inv_stocklevels.inv_items_id', '=', 'inv_department__items.id')
        ->leftJoin('inv_items', 'inv_department__items.inv_item_id', '=', 'inv_items.id')
        ->leftJoin('departments', 'inv_department__items.department_id', '=', 'departments.id')
        ->leftJoin('inv_uoms', 'inv_items.inv_uom_id', '=', 'inv_uoms.id')
        ->leftJoin('inv_suppliers', 'inv_items.supplier_id', '=', 'inv_suppliers.id')
        ->select('*', 'inv_stocklevels.id as stock_id', 'inv_department__items.id as dptitemid')
        ->where('inv_stocklevels.stock_code', $id)
        ->where('inv_stocklevels.is_active', 0)
        ->get(); // getting all records entered on that stock code

        return view('inventdashboard.receiveStock', compact('items', 'suppliers', 'code', 'values', 'stores'));
    }

    public function viewstockdetails(Request $request, $id)
    {
        $code = $request->route('id'); //getting the request code

        $values = invStocklevel::leftJoin('inv_department__items', 'inv_stocklevels.inv_items_id', '=', 'inv_department__items.id')
        ->leftJoin('inv_items', 'inv_department__items.inv_item_id', '=', 'inv_items.id')
        ->leftJoin('departments', 'inv_department__items.department_id', '=', 'departments.id')
        ->leftJoin('inv_uoms', 'inv_items.inv_uom_id', '=', 'inv_uoms.id')
        ->leftJoin('inv_suppliers', 'inv_items.supplier_id', '=', 'inv_suppliers.id')
        ->select('*', 'inv_stocklevels.id as stock_id', 'inv_items.id as itemid')
        ->where('inv_stocklevels.stock_code', $id)
        ->where('inv_stocklevels.is_active', 1)
        ->get(); // getting all records entered on that stock code

        return view('inventdashboard.stockDetailed', compact('code', 'values'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'department_id' => 'required',
            'supplier_id' => 'required',
            'stock_qty' => 'required|numeric',
            'unit_cost' => 'required',
            'date_added' => 'required',
            'inv_items_id' => 'required',
            'stock_code' => 'required',
        ]);
        if ($request->input('supplier_id') == 'null') {
            $sup = null;
        } else {
            $sup = $request->input('supplier_id');
        }
        $code = $request->route('id');
        $total_cost = $request->input('unit_cost') * $request->input('stock_qty');
        $scode = $request->input('stock_code');
        $itemid = $request->input('inv_items_id');
        $isExist = invStocklevel::select('*')
        ->where('inv_stocklevels.stock_code', $scode)
        ->where('inv_stocklevels.inv_items_id', $itemid)
        ->exists();
        if ($isExist) {
            invStocklevel::where('inv_stocklevels.stock_code', $scode)
            ->where('inv_stocklevels.inv_items_id', $itemid)
            //->increment('stock_qty',$request->input('stock_qty'))
            ->update([
                'stock_qty' => DB::raw('stock_qty + '.$request->input('stock_qty')),
                'total_cost' => DB::raw('total_cost + '.$total_cost),
            ]);

            return  redirect()->back()->with('success', 'Record Successfully updated !!');
        } else {
            $value = new invStocklevel();
            $value->department_id = $request->input('department_id');
            $value->supplier_id = $sup;
            $value->stock_qty = $request->input('stock_qty');
            $value->batch_no = $request->input('batch_no');
            $value->unit_cost = $request->input('unit_cost');
            $value->total_cost = $total_cost;
            $value->date_added = $request->input('date_added');
            $value->expiry_date = $request->input('expiry_date');
            $value->inv_items_id = $request->input('inv_items_id');
            $value->inv_store_id = $request->input('inv_store_id');
            $value->stock_code = $request->input('stock_code');
            $value->user_id = auth()->user()->id;
            $value->stock_year = date('Y');
            $value->stock_month = date('M-Y');
            $value->stock_week = date('Y-M-W');
            $value->save();

            return  redirect()->back()->with('success', 'Record Successfully added !!');
        }
    }

    public function getitemData(Request $request)
    {
        // Fetch Employees by Departmentid
        $itemData['data'] = inv_department_Item::leftJoin('inv_items', 'inv_department__items.inv_item_id', '=', 'inv_items.id')
        ->leftJoin('departments', 'inv_department__items.department_id', '=', 'departments.id')
        ->leftJoin('inv_suppliers', 'inv_items.supplier_id', '=', 'inv_suppliers.id')
                    ->select('departments.id as dptid', 'departments.department_name as dptname', 'inv_suppliers.id as supid', 'inv_suppliers.sup_name as suppliername', 'inv_items.cost_price as cost', 'inv_department__items.qty_left as qtyleft', 'inv_department__items.qty_held as qtyheld', 'expires')
                    ->where('inv_department__items.id', $request->item_id)
                    ->get();

        return response()->json($itemData);
    }

    public function saveStock(Request $request)
    {
        $this->validate($request, [
            'item' => 'required',
            'quantity' => 'required',
            'stockcode' => 'required',
            'delivery_no' => 'required',
            'lpo' => 'required',
            'grn' => 'required',

        ]);
        $stockcode = $request->input('stockcode');
        invStocklevel::where('inv_stocklevels.stock_code', $stockcode)
        ->update(['is_active' => '1', 'delivery_no' => $request->input('delivery_no'), 'lpo' => $request->input('lpo'), 'grn' => $request->input('grn')]);
        // $value = invItems::where('inv_stocklevels.stock_code', $stockcode);
        // $value->is_active = 1;
        // $value->delivery_no = $request->input('delivery_no');
        // $value->lpo = $request->input('lpo');
        // $value->grn = $request->input('grn');
        // $value->update();
        foreach ($request->input('item') as $key => $value) {
            $item = $value;
            $qty = $request->input('quantity')[$key];
            inv_department_Item::where('inv_department__items.id', $item)
            ->increment('qty_left', $qty);
        }

        return  redirect('inventory/stockLevels')->with('success', 'Record Successfully added !!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $value = invStocklevel::find($id);
        $value->delete();

        return redirect()->back()->with('success', 'Record deleted successfully !!');
    }

    public function destroystock($id)
    {
        $value = invStocklevel::where('stock_code', $id)
        //->firstorfail()
        ->delete();

        return redirect()->back()->with('success', 'Records deleted successfully !!');
    }
}
