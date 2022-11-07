<?php

namespace App\Providers;

use App\Models\Department;
use App\Models\FacilityInformation;
use App\Models\Humanresource\Employee;
use App\Models\Humanresource\Holiday;
use App\Models\Humanresource\Suggestion;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // View::share('facilityInfo', FacilityInformation::first());
        // View::share('birthdays', Employee::whereMonth('birthday', date('m'))->whereDay('birthday', date('d'))->latest()->get());
        // View::share('holidays', Holiday::whereMonth('start_date', '=', date('m'))->whereDay('start_date', '=', (date('d') + 1))->get());
        // View::share('suggestions', Suggestion::latest()->get());
        // View::share('departments', Department::where(['status' => 'Active', 'type' => 'Unit'])->orWhere('type', 'Laboratory')->latest()->get());
    }
}
