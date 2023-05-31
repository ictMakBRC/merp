<?php

namespace App\Http\Controllers\inventory;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\inventory\inv_department_Item;
use App\Models\inventory\invItems;
use App\Models\inventory\invRequest;
use App\Models\inventory\invRequestitem;
use App\Models\inventory\invUserdeparment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RequestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //new request internal--------------------------------------------------------------------------------
    public function index()
    {
        $userid = auth()->user()->id;
        $units = invUserdeparment::leftJoin('departments', 'inv_userdeparments.department_id', '=', 'departments.id')
        ->where('inv_userdeparments.user_id', $userid)
        ->get();

        return view('inventdashboard.selectdepartment', compact('units'));
    }

    //request external----------------------------------------------------------------------------------------
    public function external()
    {
        $userid = auth()->user()->id;
        $units = invUserdeparment::leftJoin('departments', 'inv_userdeparments.department_id', '=', 'departments.id')
        ->where('inv_userdeparments.user_id', $userid)
        ->get();
        $borrower = Department::orderBy('department_name', 'asc')->get();

        return view('inventdashboard.requestnewlend', compact('units', 'borrower'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $unit = $request->input('department_id');

        $this->validate($request, [
            'department_id' => 'required',
            'user_id' => 'required',
            'request_code' => 'required',
            'approver_id' => 'required',

        ]);
        $code = $request->input('request_code');
        $value = new invRequest();
        $value->department_id = $request->input('department_id');
        $value->request_code = $request->input('request_code');
        $value->user_id = $request->input('user_id');
        $value->inventoryclerk_id = $request->input('inventoryclerk_id');
        $value->date_added = date('Y-m-d');
        $value->approver_id = $request->input('approver_id');
        $value->request_year = date('Y');
        $value->request_month = date('M-Y');
        $value->request_week = date('Y-M-W');
        $value->save();
    //             return  redirect()->back()->with('success', 'Record Successfully added !!');

    //    // return view('inventdashboard.requestDetails', compact('code'));
        return  redirect('inventory/request/items/'.$code)->with('success', 'Record Successfully added, please move to the next step !!');
    }

    public function create2(Request $request)
    {
        $unit = $request->input('department_id');

        $this->validate($request, [
            'department_id' => 'required',
            'user_id' => 'required',
            'request_code' => 'required',
            'approver_id' => 'required',
            'borrower_id' => 'required',

        ]);
        $code = $request->input('request_code');
        $value = new invRequest();
        $value->department_id = $request->input('department_id');
        $value->request_code = $request->input('request_code');
        $value->borrower_id = $request->input('borrower_id');
        $value->request_type = 'External';
        $value->user_id = $request->input('user_id');
        $value->inventoryclerk_id = $request->input('inventoryclerk_id');
        $value->date_added = date('Y-m-d');
        $value->approver_id = $request->input('approver_id');
        $value->request_year = date('Y');
        $value->request_month = date('M-Y');
        $value->request_week = date('Y-M-W');
        $value->save();
    //             return  redirect()->back()->with('success', 'Record Successfully added !!');

    //    // return view('inventdashboard.requestDetails', compact('code'));
        return  redirect('inventory/request/items/'.$code)->with('success', 'Record Successfully added, please move to the next step !!');
    }

    public function getApprover(Request $request)
    {
        $approvers = invUserdeparment::leftJoin('users', 'inv_userdeparments.user_id', '=', 'users.id')
        ->where('inv_userdeparments.department_id', $request->unit_id)
        ->where('inv_userdeparments.role', 2)
        ->pluck('users.name as uname', 'users.id as uid');

        return response()->json($approvers);
    }

 public function requestItems(Request $request, $id)
 {
     $code = $request->route('id'); //getting the request code
     $requesters = invRequest::leftJoin('departments', 'inv_requests.department_id', '=', 'departments.id')
     ->leftJoin('users', 'inv_requests.approver_id', '=', 'users.id')
     ->select('department_name as dname', 'users.name as uname', 'inv_requests.request_type as type', 'inv_requests.id as requestid', 'inv_requests.date_added as requestdate')
     ->where('inv_requests.request_code', $id)
     ->where('inv_requests.user_id', auth()->user()->id)
     ->where('inv_requests.request_state', 'open')
     ->orWhere('inv_requests.request_state', 'rejected')
     ->where('inv_requests.is_active', 0)->get();

     $items = invRequest::leftJoin('inv_department__items', 'inv_requests.department_id', '=', 'inv_department__items.department_id')
     ->leftJoin('inv_items', 'inv_department__items.inv_item_id', '=', 'inv_items.id')
     ->leftJoin('inv_uoms', 'inv_items.inv_uom_id', '=', 'inv_uoms.id')
     ->where('inv_requests.request_code', $id)
    // ->where('inv_requests.user_id', auth()->user()->id)
     ->select('*', 'inv_department__items.id as item_id')->get();
     $borrowers = invRequest::leftJoin('departments', 'inv_requests.borrower_id', '=', 'departments.id')
     ->select('department_name as bdname', 'inv_requests.request_type as btype', 'departments.id as bdid')
     ->where('inv_requests.user_id', auth()->user()->id)
     ->where('inv_requests.request_code', $id)->get();

     $values = invRequestitem::leftJoin('inv_department__items', 'inv_requestitems.inv_items_id', '=', 'inv_department__items.id')
     ->leftJoin('inv_items', 'inv_department__items.inv_item_id', '=', 'inv_items.id')
     ->leftJoin('inv_uoms', 'inv_items.inv_uom_id', '=', 'inv_uoms.id')
     ->where('inv_requestitems.request_code', $id)
     ->where('inv_requestitems.is_active', 0)
     ->where('inv_requestitems.item_state', 'open')
     ->select('*', 'inv_requestitems.id as ritem_id', 'inv_department__items.id as item')->get();

     return view('inventdashboard.requestDetails', compact('code', 'values', 'requesters', 'items', 'borrowers'));
 }

public function getitemData(Request $request)
{
    $itemData1 = invRequestitem::where('inv_items_id', $request->item_id)->where('item_state', 'open')
    ->select(DB::raw('sum(inv_requestitems.request_qty) as qtyheld'))->get();
    $itemData = inv_department_Item::leftJoin('inv_items', 'inv_department__items.inv_item_id', '=', 'inv_items.id')
        ->leftJoin('departments', 'inv_department__items.department_id', '=', 'departments.id')
    ->leftJoin('inv_suppliers', 'inv_items.inv_supplier_id', '=', 'inv_suppliers.id')
                ->select('qty_left as qtyleft', 'inv_items.id as item')
                ->where('inv_department__items.id', $request->item_id)
                ->get();
    $item = array_merge(compact('itemData', 'itemData1'));

    return response()->json($item);
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
            'inv_requests_id' => 'required',
            'request_code' => 'required',
            'inv_items_id' => 'required',
            'request_qty' => 'required',
            'inv_item_id' => 'required',
        ]);
        $isExist = invRequestitem::select('*')
        ->where('inv_requestitems.request_code', $request->input('request_code'))
        ->where('inv_requestitems.inv_items_id', $request->input('inv_items_id'))
        ->exists();
        if ($isExist) {
            invRequestitem::where('inv_requestitems.request_code', $request->input('request_code'))
            ->where('inv_requestitems.inv_items_id', $request->input('inv_items_id'))
            ->increment('request_qty', $request->input('request_qty'));
            // invItems::where('id', $request->input('inv_items_id'))->increment('qty_held',$request->input('request_qty'));
            return  redirect()->back()->with('success', 'Record Successfully updated !!');
        } else {
            $code = $request->input('request_code');
            $value = new invRequestitem();
            $value->inv_requests_id = $request->input('inv_requests_id');
            $value->request_code = $request->input('request_code');
            $value->inv_items_id = $request->input('inv_items_id');
            $value->inv_item_id = $request->input('inv_item_id');
            $value->request_qty = $request->input('request_qty');
            $value->users_id = auth()->user()->id;
            $value->save();
            // invItems::where('id', $request->input('inv_items_id'))->increment('qty_held',$request->input('request_qty'));
            return  redirect('inventory/request/items/'.$code)->with('success', 'Item Successfully added !!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $qty = $request->qty;
        $item = $request->item;
        // invItems::find($item)->decrement('qty_held',$qty);
        try {
            invRequestitem::where('id', $id)->where('is_active', 0)->delete();
            //invItems::where('id', $item) ->update(['qty_held' => DB::raw('qty_held - '.$qty)]);
            return redirect()->back()->with('success', 'Record deleted successfully !!');
        } catch(\Exception $error) {
            return redirect()->back()->with('error', 'Record can not be deleted !!');
        }
    }

    public function destroyRequest(Request $request)
    {
        try {
            foreach ($request->input('item') as $key => $value) {
                $item = $value;
                $qty = $request->input('quantity')[$key];
                //invItems::where('id', $item) ->update(['qty_held' => DB::raw('qty_held - '.$qty)]);
                $id = $request->input('requestcode');
                invRequestitem::where('request_code', $id)->delete();
                invRequest::where('request_code', $id)->delete();

                return redirect('inventory/request/new')->with('success', 'Records deleted successfully !!');
            }
        } catch(\Exception $error) {
            $id = $request->input('requestcode');
            invRequestitem::where('request_code', $id)->delete();
            invRequest::where('request_code', $id)->delete();

            return redirect('inventory/request/new')->with('success', 'Records deleted successfully!');
        }
    }

  public function confirmRequest($id)
  {
      try {
          invRequest::where('request_code', $id)->update(['is_active' => 1,
              'request_state' => 'Not signed',
          ]);

          invRequestitem::where('request_code', $id)->update(['is_active' => 1]);

          return redirect('inventory/request/view/'.$id)->with('success', 'Records submitted successfully !!');
      } catch(\Exception $error) {
          return redirect()->back()->with('error', 'Something occared');
      }
  }

    public function Viewrequest(Request $request, $id)
    {
        $code = $request->route('id'); //getting the request code
        $requesters = invRequest::leftJoin('departments', 'inv_requests.department_id', '=', 'departments.id')
         ->leftJoin('users', 'inv_requests.approver_id', '=', 'users.id')
         ->select('department_name as dname', 'users.name as uname', 'inv_requests.request_type as type', 'inv_requests.id as requestid', 'inv_requests.created_at as requestdate', 'inv_requests.request_state as state','acknowledged_by')
           ->where('inv_requests.request_code', $id)->first();
        $requestby = invRequest::leftJoin('users', 'inv_requests.user_id', '=', 'users.id')
         ->where('inv_requests.request_code', $id)->first();

        $inventAdmin = invRequest::leftJoin('users', 'inv_requests.inventoryclerk_id', '=', 'users.id')
          ->where('inv_requests.request_code', $id)->get();

        $borrowers = invRequest::leftJoin('departments', 'inv_requests.borrower_id', '=', 'departments.id')
        ->select('department_name as bdname', 'inv_requests.request_type as btype', 'departments.id as bdid')
        ->where('inv_requests.request_code', $id)->get();

        $values = invRequestitem::leftJoin('inv_department__items', 'inv_requestitems.inv_items_id', '=', 'inv_department__items.id')
        ->leftJoin('inv_items', 'inv_department__items.inv_item_id', '=', 'inv_items.id')
        ->leftJoin('inv_uoms', 'inv_items.inv_uom_id', '=', 'inv_uoms.id')
        ->where('inv_requestitems.request_code', $id)
        ->select('*', 'inv_requestitems.id as ritem_id', 'inv_items.id as item')->get();

        return view('inventdashboard.requestView', compact('code', 'values', 'requesters', 'requestby', 'inventAdmin', 'borrowers'));
    }

    public function SubmittedRequests()
    {
        $values = invRequest::leftJoin('departments', 'inv_requests.department_id', '=', 'departments.id')
        ->leftJoin('users', 'inv_requests.approver_id', '=', 'users.id')
        ->select('request_state', 'request_type', 'request_code', 'department_name as dname', 'users.name as uname', 'inv_requests.request_type as type', 'inv_requests.id as requestid', 'inv_requests.updated_at as requestdate')
        ->where('inv_requests.request_state', '!=', 'open')
        ->where('inv_requests.user_id', auth()->user()->id)
        ->where('inv_requests.is_active', 1)->get();

        return view('inventdashboard.requestsSubmitted', compact('values'));
    }

    public function DraftRequests()
    {
        $values = invRequest::leftJoin('departments', 'inv_requests.department_id', '=', 'departments.id')
        ->leftJoin('users', 'inv_requests.approver_id', '=', 'users.id')
        ->select('request_state', 'request_type', 'request_code', 'department_name as dname', 'users.name as uname', 'inv_requests.request_type as type', 'inv_requests.id as requestid', 'inv_requests.updated_at as requestdate')
        ->where('inv_requests.request_state', 'open')
        ->orWhere('inv_requests.request_state', 'rejected')
        ->where('inv_requests.user_id', auth()->user()->id)
        ->where('inv_requests.is_active', 0)->get();

        return view('inventdashboard.requestsDraft', compact('values'));
    }

    public function PendingApprovels()
    {
        $sign = 'inline';
        $values = invRequest::leftJoin('departments', 'inv_requests.department_id', '=', 'departments.id')
        ->leftJoin('users', 'inv_requests.approver_id', '=', 'users.id')
        ->select('request_state', 'request_type', 'request_code', 'department_name as dname', 'users.name as uname', 'inv_requests.request_type as type', 'inv_requests.id as requestid', 'inv_requests.updated_at as requestdate')
        ->where('inv_requests.request_state', '=', 'Submitted')
        ->where('inv_requests.approver_id', auth()->user()->id)
        ->where('inv_requests.is_active', 1)->get();

        return view('inventdashboard.requestsPending', compact('values', 'sign'));
    }

    public function ApprovedRequests()
    {
        $sign = 'none';
        $values = invRequest::leftJoin('departments', 'inv_requests.department_id', '=', 'departments.id')
        ->leftJoin('users', 'inv_requests.approver_id', '=', 'users.id')
        ->select('request_state', 'request_type', 'request_code', 'department_name as dname', 'users.name as uname', 'inv_requests.request_type as type', 'inv_requests.id as requestid', 'inv_requests.updated_at as requestdate')
        ->where('inv_requests.request_state', 'signed')
        ->orwhere('inv_requests.request_state', 'Approved')
        ->where('inv_requests.approver_id', auth()->user()->id)
        ->where('inv_requests.is_active', 1)->get();

        return view('inventdashboard.requestsPending', compact('values', 'sign'));
    }

    public function InventoryRequests()
    {
        $sign = 'none';
        $values = invRequest::leftJoin('departments', 'inv_requests.department_id', '=', 'departments.id')
        ->leftJoin('users', 'inv_requests.approver_id', '=', 'users.id')
        ->select('request_state', 'request_type', 'request_code', 'department_name as dname', 'users.name as uname', 'inv_requests.request_type as type', 'inv_requests.id as requestid', 'inv_requests.updated_at as requestdate')
        ->where('inv_requests.request_state', 'signed')
        //->where('inv_requests.approver_id', auth()->user()->id)
        ->where('inv_requests.is_active', 1)->get();

        return view('inventdashboard.requestsInventoryApprovel', compact('values', 'sign'));
    }

    public function InventoryRequestsViewed()
    {
        $sign = 'none';
        $values = invRequest::leftJoin('departments', 'inv_requests.department_id', '=', 'departments.id')
        ->leftJoin('users', 'inv_requests.approver_id', '=', 'users.id')
        ->select('request_state', 'request_type', 'request_code', 'department_name as dname', 'users.name as uname', 'inv_requests.request_type as type', 'inv_requests.id as requestid', 'inv_requests.updated_at as requestdate')
        ->where('inv_requests.request_state', 'Approved')
        ->orWhere('inv_requests.request_state', 'rejected')
        ->where('inv_requests.inventoryclerk_id', auth()->user()->id)
        ->where('inv_requests.is_active', 1)->get();

        return view('inventdashboard.requestsInventoryApprovel', compact('values', 'sign'));
    }

    public function InventoryRequests2()
    {
        $sign = 'none';
        $values = invRequest::leftJoin('departments', 'inv_requests.department_id', '=', 'departments.id')
        ->leftJoin('users', 'inv_requests.approver_id', '=', 'users.id')
        ->select('request_state', 'request_type', 'request_code', 'department_name as dname', 'users.name as uname', 'inv_requests.request_type as type', 'inv_requests.id as requestid', 'inv_requests.updated_at as requestdate')
        ->where('inv_requests.request_state', 'signed')
        //->where('inv_requests.approver_id', auth()->user()->id)
        ->where('inv_requests.is_active', 1)->get();

        return view('inventdashboard.requestsInventoryApprovel', compact('values', 'sign'));
    }

    public function ApproveRequest(Request $request, $id)
    {
        $code = $request->route('id'); //getting the request code
        $requesters = invRequest::leftJoin('departments', 'inv_requests.department_id', '=', 'departments.id')
        ->leftJoin('users', 'inv_requests.approver_id', '=', 'users.id')
        ->select('department_name as dname', 'users.name as uname', 'inv_requests.request_type as type', 'inv_requests.id as requestid', 'inv_requests.updated_at as requestdate')
        ->where('inv_requests.request_code', $id)->get();
        $requestby = invRequest::leftJoin('users', 'inv_requests.user_id', '=', 'users.id')
        ->where('inv_requests.request_code', $id)->get();
        $inventAdmin = invRequest::leftJoin('users', 'inv_requests.inventoryclerk_id', '=', 'users.id')
        ->where('inv_requests.request_code', $id)->get();
        $values = invRequestitem::leftJoin('inv_department__items', 'inv_requestitems.inv_items_id', '=', 'inv_department__items.id')
        ->leftJoin('inv_items', 'inv_department__items.inv_item_id', '=', 'inv_items.id')
        ->leftJoin('inv_uoms', 'inv_items.inv_uom_id', '=', 'inv_uoms.id')
        ->where('inv_requestitems.request_code', $id)
        ->select('*', 'inv_requestitems.id as ritem_id', 'inv_items.id as item')->get();

        return view('inventdashboard.requestActions', compact('code', 'values', 'requesters', 'requestby', 'inventAdmin'));
    }

    public function UpdateRequestState(Request $request)
    {
        $this->validate($request, [
            'code' => 'required',
            'approve' => 'required',
            'comments' => 'required',
            'isactive' => 'required|numeric',
        ]);
        $id = $request->input('code');
        try {
            invRequest::where('request_code', $id)->update(['is_active' => $request->input('isactive'),
                'request_state' => $request->input('approve'), 'reqcomment' => $request->input('comments'),
                'approver_id' => auth()->user()->id,
            ]);
            invRequestitem::where('request_code', $id)->update(['is_active' => $request->input('isactive')]);

            return redirect('inventory/request/view/'.$id)->with('success', 'Records Approveds successfully !!');
        } catch(\Exception $error) {
            return redirect()->back()->with('error', 'Something occared');
        }
    }

    public function AcknowledgeRequest(Request $request)
    {
        $this->validate($request, [
            'code' => 'required',
            'approve' => 'required',
        ]);
        $id = $request->input('code');
        try {
            invRequest::where('request_code', $id)->update(['acknowledged_by' => auth()->user()->id,
                'acknowledgement' => $request->input('approve'),
            ]);

            return redirect('inventory/request/view/'.$id)->with('success', 'Records Approveds successfully !!');
        } catch(\Exception $error) {
            return redirect()->back()->with('error', 'Something occared');
        }
    }

    //inventory admin view request ==========================================================================================
    public function InventorySingleRequest(Request $request, $id)
    {
        $code = $request->route('id'); //getting the request code
        $requesters = invRequest::leftJoin('departments', 'inv_requests.department_id', '=', 'departments.id')
        ->leftJoin('users', 'inv_requests.approver_id', '=', 'users.id')
        ->select('department_name as dname', 'users.name as uname', 'inv_requests.request_type as type', 'inv_requests.id as requestid', 'inv_requests.updated_at as requestdate')
        ->where('inv_requests.request_code', $id)->get();

        $borrowers = invRequest::leftJoin('departments', 'inv_requests.borrower_id', '=', 'departments.id')
        ->select('department_name as bdname', 'inv_requests.request_type as btype', 'departments.id as bdid')
        ->where('inv_requests.request_code', $id)->get();

        $requestby = invRequest::leftJoin('users', 'inv_requests.user_id', '=', 'users.id')
        ->where('inv_requests.request_code', $id)->get();

        $inventAdmin = invRequest::leftJoin('users', 'inv_requests.inventoryclerk_id', '=', 'users.id')
        ->where('inv_requests.request_code', $id)->get();

        $values = invRequestitem::leftJoin('inv_department__items', 'inv_requestitems.inv_items_id', '=', 'inv_department__items.id')
        ->leftJoin('inv_items', 'inv_department__items.inv_item_id', '=', 'inv_items.id')
        ->leftJoin('inv_uoms', 'inv_items.inv_uom_id', '=', 'inv_uoms.id')
        ->leftJoin('inv_requests', 'inv_requestitems.request_code', '=', 'inv_requests.request_code')
        ->where('inv_requestitems.request_code', $id)
        ->select('*', 'inv_requestitems.id as ritem_id', 'inv_department__items.id as item', 'inv_department__items.inv_item_id as invItem', 'inv_requests.borrower_id as borrower')->get();

        return view('inventdashboard.requestInvtoryView', compact('code', 'values', 'requesters', 'requestby', 'inventAdmin', 'borrowers'));
    }

//inventory admin reject/approve request ==========================================================================================
    public function updateInventoryRequest(Request $request)
    {
        if ($request->input('request_type') == 'External') {
            $this->validate($request, [
                'code' => 'required',
                'approve' => 'required',
                'comments' => 'required',
                'item' => 'required',
                'quantity' => 'required',
                'isactive' => 'required|numeric',
                'itemstate' => 'required',
                'borrower_id' => 'required',
                'request_type' => 'required',
            ]);
        } else {
            $this->validate($request, [
                'code' => 'required',
                'approve' => 'required',
                'comments' => 'required',
                'item' => 'required',
                'quantity' => 'required',
                'isactive' => 'required|numeric',
                'itemstate' => 'required',
                'borrower_id',
            ]);
        }

        $id = $request->input('code');
        if ($request->input('approve') == 'rejected') {
            invRequest::where('request_code', $id)->update(['is_active' => $request->input('isactive'),
                'request_state' => $request->input('approve'), 'date_approved' => date('Y-m-d'), 'reqcomment' => $request->input('comments'),
                'inventoryclerk_id' => auth()->user()->id, ]);
            invRequestitem::where('request_code', $id)->update(['is_active' => '0']);

            return redirect('inventory/request/view/'.$id)->with('success', 'Records successfully rejected!!');
        } else {
            try {
                invRequest::where('request_code', $id)->update(['is_active' => $request->input('isactive'),
                    'request_state' => $request->input('approve'), 'date_approved' => date('Y-m-d'), 'reqcomment' => $request->input('comments'),
                    'inventoryclerk_id' => auth()->user()->id, ]);

                foreach ($request->input('item') as $key => $value) {
                    $item = $value;
                    $qty = $request->input('quantity')[$key];
                    invRequestitem::where('request_code', $id)
                    ->where('inv_items_id', $item)
                    ->update(['is_active' => $request->input('isactive'), 'qty_given' => $qty, 'item_state' => $request->input('itemstate')]);
                    inv_department_Item::where('inv_department__items.id', $item)
                    ->decrement('qty_left', $qty);
                }
                //if request is from external==========================================================
                if ($request->input('request_type') == 'External') {
                    foreach ($request->input('invitem') as $key => $value) {
                        $item = $value;
                        $qty = $request->input('quantity')[$key];
                        $dpt = $request->input('borrower_id')[$key];
                        inv_department_Item::where('inv_department__items.inv_item_id', $item)
                        ->where('inv_department__items.department_id', $dpt)
                        ->increment('qty_held', $qty);
                    }
                }

                return redirect('inventory/request/view/'.$id)->with('success', 'Records Approveds successfully !!');
            } catch(\Exception $error) {
                return redirect()->back()->with('error', 'Something occared');
            }
        }
    }
}
