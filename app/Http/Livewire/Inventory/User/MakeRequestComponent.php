<?php

namespace App\Http\Livewire\Inventory\User;

use Livewire\Component;
use App\Models\inventory\invItems;
use Illuminate\Support\Facades\DB;
use App\Models\inventory\invRequest;
use App\Models\inventory\invRequestitem;
use App\Models\inventory\invUserdeparment;
use App\Models\inventory\inv_department_Item;

class MakeRequestComponent extends Component
{
    public $request_code, $department_id, $approver_id;
    public $active ='items', $inv_requests_id, $inv_items_id;
    public $qty_left = 0, $request_qty, $inv_item_id;
    public function mount($code)
    {
        if (auth()->user()->hasRole(['InvSupervisor', 'InvUser']) && session('department') != null) {
            $this->request_code = $code;
        } else {
            return to_route('inv_user.dashboard')->with('error', 'Please selecte a departmet');
        }
    }
    public function updatedInvItemsId()
    {
       $this->qty_left = 0;
       $activeItem = inv_department_Item::where('id',$this->inv_items_id)->first();
       $this->qty_left = $activeItem->qty_left - $activeItem->qty_held;
       $this->inv_item_id = $activeItem->inv_item_id;
       $this->request_qty = 0;
    }
    public function createRequest()
    {
        
        $this->validate([
            'department_id' => 'required',
            'request_code' => 'required',
            'approver_id' => 'required',

        ]);
        $requestDetails = invRequest::where('request_code',$this->request_code)->first();
        if($requestDetails){
            $this->approver_id = $requestDetails->approver_id;
            $this->request_code = $requestDetails->request_code;
            $this->active = 'items';
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Request resumed']);
        }else{
            $value = new invRequest();
            $value->department_id = $this->department_id;
            $value->request_code = $this->request_code;
            $value->user_id = auth()->user()->id;
            $value->approver_id = $this->approver_id;
            $value->date_added = date('Y-m-d');
            $value->request_year = date('Y');
            $value->request_month = date('M-Y');
            $value->request_week = date('Y-M-W');
            $value->save();
            $this->active = 'items';
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Request created successfully, please proceed']);
        }

    }
    public function addItem()
    {
        $this->validate([
            'inv_item_id' => 'required',
            'request_code' => 'required',
            'inv_items_id' => 'required',
            'request_qty' => 'required',
        ]);
        $isExist = invRequestitem::where('request_code', $this->request_code)
        ->where('inv_items_id', $this->inv_items_id)
        ->exists();
        if ($isExist) {
            invRequestitem::where('inv_requestitems.request_code', $this->request_code)
            ->where('inv_requestitems.inv_items_id', $this->inv_items_id)
            ->increment('request_qty', $this->request_qty);
            inv_department_Item::where('id', $this->inv_items_id)->increment('qty_held',$this->request_qty);
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Record Successfully updated !']);
        } else {
            $value = new invRequestitem();
            $value->inv_requests_id = $this->inv_requests_id;
            $value->request_code = $this->request_code;
            $value->inv_items_id = $this->inv_items_id;
            $value->inv_item_id = $this->inv_item_id;
            $value->request_qty = $this->request_qty;
            $value->users_id = auth()->user()->id;
            $value->save();
            inv_department_Item::where('id', $this->inv_items_id)->increment('qty_held',$this->request_qty);
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Item Successfully added']);
        }
        $this->resetInputs();
    }
    public function destroyItem(invRequestitem $request)
    {
        $id = $request->id;
        $qty = $request->request_qty;
        $item = $request->inv_items_id;
        try {
            inv_department_Item::where('id', $item) ->update(['qty_held' => DB::raw('qty_held - '.$qty)]);
            invRequestitem::where('id', $id)->where('is_active', 0)->delete();
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Record deleted successfully']);
        } catch(\Exception $error) {
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'error',
                'message' => 'Something went wrong!',
                'text' => 'Failed to remove the item from the list, please refresh try again.',
            ]);
            // $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'Record can not be deleted']);
        }
    }
    public function resetInputs()
    {
        $this->reset([
            'inv_items_id',
            'request_qty',
            'qty_left',
            'inv_item_id',
        ]);
    }
    public function submitRequest($code)
    {
        try {
            invRequest::where('request_code', $code)->update(['is_active' => 1,
                'request_state' => 'Submitted',
            ]);
  
            invRequestitem::where('request_code', $code)->update(['is_active' => 1]);  
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Request Successfully submitted']);
            $this->requestPreviewRoute($code);
        } catch(\Exception $error) {
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'error',
                'message' => 'Something went wrong!',
                'text' => 'Failed to submit, please refresh your browser and try again.',
            ]);
        }
    }
    public function requestPreviewRoute($code)
    {
        return redirect('inventory/request/view/'.$code)->with('success', 'Request submitted successfully !!');
    }
    public function previewRequest()
    {
        $this->active='preview';
    }
    public function defultRoute()
    {
        return to_route('inv_user.dashboard')->with('error', 'Please selecte a departmet');
    }
    public function render()
    {
        if (auth()->user()->hasRole(['InvSupervisor', 'InvUser']) && session('department') != null) {
            $this->department_id =session('department');
            $data['approvers'] = invUserdeparment::with('user')->where('department_id', session('department'))->get();
            $data['requestDetails']= $requestDetails = invRequest::with('requester','approver','department','borrower')->where(['request_code'=> $this->request_code, 'department_id'=> session('department')])->first();
            if($requestDetails){
                if($requestDetails->request_state =='Submitted' || $requestDetails->request_state =='Approved'){
                    $this->requestPreviewRoute($requestDetails->request_code);
                }
            }
            $data['requestItems']=invRequestitem::with('item','item.parentUom','item.subUnit')->where('request_code', $this->request_code)->get();
            $data['items'] = inv_department_Item::with('item','item.parentUom')->where('department_id', session('department'))->get();
            if($requestDetails){
                $this->approver_id = $requestDetails->approver_id;
                $this->request_code = $requestDetails->request_code;
                $this->inv_requests_id = $requestDetails->id;
                // $this->active = 'items';
            }else{
                $this->active = '1';
            }

        } else {
            $this->defultRoute();
        }
        return view('livewire.inventory.user.make-request-component',$data)->layout('inventdashboard.layouts.app');
    }
}
