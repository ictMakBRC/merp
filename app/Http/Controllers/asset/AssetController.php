<?php

namespace App\Http\Controllers\asset;

use App\Exports\AssetsExport;
use App\Http\Controllers\Controller;
use App\Models\asset\Asset;
use App\Models\asset\AssetCategory;
use App\Models\asset\AssetIssue;
use App\Models\asset\AssignmentHistory;
use App\Models\asset\InsuranceType;
use App\Models\Department;
use App\Models\Station;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assets = Asset::with('category:id,category_name', 'subcategory:id,subcategory_name',
                        'user:id,name', 'vendor:id,vendor_name', 'station:id,station_name',
                        'department:id,department_name', 'insurer:id,vendor_name')->orderBy('created_at', 'desc')->get();

        $departmentCount = Department::count();
        $issueCount = AssetIssue::count();
        $userCount = User::count();
        //return $assets;
        return view('assets.dashboard', compact('assets', 'departmentCount', 'issueCount', 'userCount'));
    }

    // public function export($id)
    // {
    //     return Excel::download(new AssetsExport($id), 'assets.xlsx');
    // }
    public function export()
    {
        return Excel::download(new AssetsExport(), 'assets.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::select('id', 'name')->get();
        $stations = Station::select('id', 'station_name')->get();
        $departments = Department::select('id', 'department_name')->get();
        $categories = AssetCategory::select('id', 'category_name')->get();
        $subcats = AssetCategory::select('id', 'category_name')->with('Subcategories:id,subcategory_name')->get();
        $vendors = Vendor::select('id', 'vendor_name')->get();
        $insurancetypes = InsuranceType::select('id', 'type')->get();

        return view('assets.createAsset', compact('users', 'stations', 'departments', 'categories', 'subcats', 'vendors', 'insurancetypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'asset_name' => ['required', 'string', 'max:255', 'unique:assets'],
            // 'asset_category_id'=>'integer',
            // 'asset_subcategory_id'=>'integer',
            // 'brand'=>'string',
            // 'model'=>'string',
            // 'serial_number'=>'string|unique:assets',
            'barcode' => 'integer|unique:assets',
            'engraved_label' => 'unique:assets',
            'status' => 'string|required',
            // 'user_id'=>'numeric',
            'station_id' => 'numeric',
            'department_id' => 'numeric',
            'condition' => 'string|required',
            // 'vendor_id'=>'numeric',
            // 'purchase_price'=>'numeric',
            // 'purchase_date'=>'string',
            // 'purchase_order_number'=>'string',
            // 'warranty_end'=>'date',
            // 'depreciation_method'=>'string',
            // 'depreciation_rate'=>'integer',
            // 'expected_useful_years'=>'integer',
            // 'insurance_company'=>'integer',
            // 'insurance_type'=>'integer',
            // 'insurance_end'=>'date',
            // 'remarks'=>'string'
        ]);

        $assignment = new AssignmentHistory;

        if ($request->filled(['user_id'])) {
            $assignment->to = $request->user_id;
            $new = Asset::create($request->all());
            $assignment->asset_id = $new->id;
            $assignment->save();

            return redirect()->back()->with('success', 'Asset Successfully added !!');
        } else {
            Asset::create($request->all());

            return redirect()->back()->with('success', 'Asset Successfully added !!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showDetail($id)
    {
        $assetDetail = Asset::leftJoin('departments', 'departments.id', '=', 'assets.department_id')->leftJoin('stations', 'stations.id', '=', 'assets.station_id')->where('assets.id', $id)->get();

        return response()->json($assetDetail);
    }

    public function show(Asset $asset)
    {
        $users = User::select('id', 'name')->get();
        $stations = Station::select('id', 'station_name')->get();
        $departments = Department::select('id', 'department_name')->get();
        $categories = AssetCategory::select('id', 'category_name')->get();
        $subcats = AssetCategory::select('id', 'category_name')->with('Subcategories')->get();
        $vendors = Vendor::select('id', 'vendor_name')->get();
        $insurancetypes = InsuranceType::select('id', 'type')->get();

        $maintenancehistory = $asset->select('id')->with(['maintenanceinfo',
            'maintenanceinfo.authorisedby:id,name',
            'maintenanceinfo.externalvendor:id,vendor_name',
            'maintenanceinfo.internalvendor:id,name',
            'maintenanceinfo.issue', 'maintenanceinfo.issue.sourcedept:id,department_name', 'maintenanceinfo.issue.createdby:id,name', ])->where('id', $asset->id)->get();

        $assignments = $asset->select('id')->with(['assignmenthistory',
            'assignmenthistory.fromuser:id,name',
            'assignmenthistory.touser:id,name', ])->where('id', $asset->id)->get();

        $asset->load('category:id,category_name', 'subcategory:id,subcategory_name',
                    'user:id,name', 'vendor:id,vendor_name', 'station:id,station_name',
                    'department:id,department_name', 'insurer:id,vendor_name', 'insurancetype:id,type')->get();
        //return $maintenancehistory;
        return view('assets.showAsset', compact('asset', 'users', 'stations', 'departments', 'categories', 'subcats', 'vendors', 'insurancetypes', 'assignments', 'maintenancehistory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Asset $asset)
    {
    }

    public function barcodes()
    {
        $barcodes = Asset::select('id', 'asset_name', 'barcode')->orderBy('id', 'desc')->get();

        //return $barcodes;
        return view('assets.barcodes', compact('barcodes'));
    }

    public function searchAsset()
    {
        return view('assets.searchAsset');
    }

    public function searchAction(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $query = $request->get('query');
            if ($query != '') {
                $data = DB::table('assets')
                ->where('asset_name', 'like', '%'.$query.'%')
                ->orWhere('barcode', 'like', '%'.$query.'%')
                ->orWhere('engraved_label', 'like', '%'.$query.'%')
                ->orWhere('brand', 'like', '%'.$query.'%')
                ->orWhere('model', 'like', '%'.$query.'%')
                ->orderBy('id', 'desc')
                ->get();
            } else {
                $emptyResult = '
        <tr>
         <td align="center" colspan="6">No Data Found</td>
        </tr>
        ';
                echo json_encode($emptyResult);
            }

            $total_row = $data->count();

            if ($total_row > 0) {
                foreach ($data as $row) {
                    $output .= '
        <tr>
         <td>'.$row->asset_name.'</td>
         <td>'.$row->brand.'</td>
         <td>'.$row->model.'</td>
         <td>'.$row->barcode.'</td>
         <td>'.$row->condition.'</td>
         <td class="table-action"><a href="'.route('asset.show', [$row->id]).'" class="action-icon"> <i class="mdi mdi-eye"></i></a>'.'.</td>
        </tr>
        ';
                }
            } else {
                $output = '
       <tr>
        <td align="center" colspan="6">No Data Found</td>
       </tr>
       ';
            }
            $data = [
                'table_data' => $output,
                'total_data' => $total_row,
            ];

            echo json_encode($data);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Asset $asset)
    {
        //
        $request->validate([
            'asset_name' => ['required', 'string', 'max:255'],
            'barcode' => 'integer|required',
            'status' => 'string|required',
            'station_id' => 'numeric',
            'department_id' => 'numeric',
            'condition' => 'string|required',

        ]);

        if ($request->has(['user_id'])) {
            $assignment = new AssignmentHistory;

            if ($asset->user_id == $request->user_id) {
                $asset->update($request->all());

                return redirect()->back()->with('success', 'Asset Successfully Updated!!');
            } else {
                $assignment->from = $asset->user_id;
                $assignment->to = $request->user_id;
                $assignment->asset_id = $asset->id;

                $asset->update($request->all());
                $assignment->save();

                return redirect()->back()->with('success', 'Asset Successfully Updated!!');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
