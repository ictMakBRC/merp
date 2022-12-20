<?php

namespace App\Http\Controllers\inventory;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\inventory\invItems;
use App\Models\inventory\invStores;
use App\Models\inventory\invSubUnits;
use App\Models\inventory\invSuppliers;
use App\Models\inventory\invUom;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $values = invItems::leftJoin('inv_subunits', 'inv_items.inv_subunit_id', '=', 'inv_subunits.id')
        ->leftJoin('inv_uoms', 'inv_items.inv_uom_id', '=', 'inv_uoms.id')
        ->select('*', 'inv_items.id as item_id')
        ->get();

        return view('inventdashboard.items', compact('values'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subcat = invSubUnits::orderBy('subunit_name', 'asc')->get();
        $uoms = invUom::orderBy('uom_name', 'asc')->get();
        $suppliers = invSuppliers::orderBy('sup_name', 'asc')->get();
        $stores = invStores::orderBy('store_name', 'asc')->get();

        return view('inventdashboard.newItem', compact('subcat', 'uoms', 'suppliers', 'stores'));
    }

    public function getSubUnits(Request $request)
    {
        $subUnits = DB::table('inv_subunits')
        ->where('department_id', $request->unit_id)
        ->pluck('subunit_name', 'id');

        return response()->json($subUnits);
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
            'inv_subunit_id' => 'required',
            'cost_price' => 'required|numeric',
            'inv_uom_id' => 'required',
            'inv_supplier_id',
            'max_qty' => 'required|numeric',
            'min_qty' => 'required|numeric',
            'item_code' => 'required',
            'description' => 'required',
            'date_added' => 'required',
            'item_name' => 'required',
        ]);

        $value = new invItems();
        $value->item_name = $request->input('item_name');
        $value->inv_subunit_id = $request->input('inv_subunit_id');
        $value->cost_price = $request->input('cost_price');
        $value->inv_uom_id = $request->input('inv_uom_id');
        $value->inv_supplier_id = $request->input('inv_supplier_id') != '' ? $request->input('inv_supplier_id') : null;
        $value->max_qty = $request->input('max_qty');
        $value->min_qty = $request->input('min_qty');
        $value->item_code = $request->input('item_code');
        $value->expires = $request->input('expires') != '' ? $request->input('expires') : 'Off';
        $value->description = $request->input('description');
        $value->date_added = $request->input('date_added');
        $value->user_id = auth()->user()->id;
        $value->save();

        return redirect('inventory/Items')->with('success', 'Record Successfully added !!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $units = Department::orderBy('name', 'asc')->get();
        $uoms = invUom::orderBy('uom_name', 'asc')->get();
        $suppliers = Supplier::orderBy('sup_name', 'asc')->get();
        $stores = invStores::orderBy('store_name', 'asc')->get();

        return view('inventdashboard.EditItemddd', compact('units', 'uoms', 'suppliers', 'stores'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $units = Department::orderBy('name', 'asc')->get();
        $uoms = invUom::orderBy('uom_name', 'asc')->get();
        $suppliers = invSuppliers::orderBy('sup_name', 'asc')->get();
        $stores = invStores::orderBy('store_name', 'asc')->get();
        $values = invItems::leftJoin('departments', 'inv_items.department_id', '=', 'departments.id')
        ->leftJoin('inv_subunits', 'inv_items.inv_subunit_id', '=', 'inv_subunits.id')
        ->leftJoin('inv_uoms', 'inv_items.inv_uom_id', '=', 'inv_uoms.id')
        ->leftJoin('inv_stores', 'inv_items.inv_store_id', '=', 'inv_stores.id')
        ->leftJoin('inv_suppliers', 'inv_items.inv_supplier_id', '=', 'inv_suppliers.id')
        ->select('*', 'inv_items.id as item_id')
        ->where('inv_items.id', $id)
        ->get();

        return view('inventdashboard.EditItem', compact('units', 'uoms', 'suppliers', 'stores', 'values'));
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
        $this->validate($request, [
            'department_id' => 'required',
            'inv_subunit_id' => 'required',
            'cost_price' => 'required|numeric',
            'inv_uom_id' => 'required',
            'inv_supplier_id',
            'max_qty' => 'required|numeric',
            'min_qty' => 'required|numeric',
            'inv_store_id' => 'required',
            'description' => 'required',
            'date_added' => 'required',
            'item_name' => 'required',
            'isActive' => 'required',
        ]);
        $value = invItems::find($id);
        $value->item_name = $request->input('item_name');
        $value->department_id = $request->input('department_id');
        $value->inv_subunit_id = $request->input('inv_subunit_id');
        $value->cost_price = $request->input('cost_price');
        $value->inv_uom_id = $request->input('inv_uom_id');
        $value->inv_supplier_id = $request->input('inv_supplier_id');
        $value->max_qty = $request->input('max_qty');
        $value->min_qty = $request->input('min_qty');
        $value->inv_store_id = $request->input('inv_store_id');
        $value->description = $request->input('description');
        $value->date_added = $request->input('date_added');
        $value->is_active = $request->input('isActive');
        // $value->user_id = auth()->user()->id;
        $value->update();

        return  redirect()->back()->with('success', 'Record Successfully updated !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $value = invItems::find($id);
        $value->delete();

        return redirect()->back()->with('success', 'Record deleted successfully !!');
    }
}
