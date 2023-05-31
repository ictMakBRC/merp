<?php

namespace App\Http\Livewire\Inventory\User;

use App\Models\Inventory\InvStockDocument;
use Livewire\Component;

class StockHistoryComponent extends Component
{
    public function defaultRoute()
    {
        return to_route('inv_user.dashboard')->with('error', 'Please selecte a departmet');
    }
    public function render()
    {
        if (auth()->user()->hasRole(['InvSupervisor', 'InvUser']) && session('department') != null) {
            $data['stockDocuments'] = InvStockDocument::with('user')
            ->where(['department_id'=> session('department'), 'is_active'=> 1])->get();
        } else {
           $this->defaultRoute();
        }

        return view('livewire.inventory.user.stock-history-component',$data)->layout('inventdashboard.layouts.app');
    }
}
