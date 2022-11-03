<?php

namespace App\Http\Controllers;

use App\Models\Humanresource\OfficialContract;
use App\Models\Humanresource\ProjectContract;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class MassUpdateController extends Controller
{
    public function contractStatusUpdate()
    {
        // $today = Carbon::today()->format('Y-m-d');
        // $next_date = Carbon::today()->addDays(90)->format('Y-m-d');

        // $today = Carbon::today()->format('Y-m-d');
        // OfficialContract::where('status', 'Running')->where('end_date', '<', $today)
        // ->update(['status' => 'Expired']);

        // ProjectContract::where('status', 'Running')->where('end_date', '<', $today)
        // ->update(['status' => 'Expired']);

        return Auth::user()->roles;
    }
}
