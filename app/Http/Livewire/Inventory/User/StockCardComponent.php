<?php

namespace App\Http\Livewire\Inventory\User;

use Livewire\Component;
use App\Models\inventory\inv_department_Item;
class StockCardComponent extends Component
{
    public function defaultRoute()
    {
        return to_route('inv_user.dashboard')->with('error', 'Please selecte a departmet');
    }
    public function render()
    {
        if (auth()->user()->hasRole(['InvSupervisor', 'InvUser']) && session('department') != null) {
            $data['items'] = inv_department_Item::with('item','item.parentUom','item.subUnit')
            ->where('department_id', session('department'))->get();
        } else {
            $this->defaultRoute();
        }
        return view('livewire.inventory.user.stock-card-component',$data)->layout('inventdashboard.layouts.app');
    }
}
