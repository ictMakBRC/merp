<?php

namespace App\Providers;

use App\Models\Department;
use App\Models\FacilityInformation;
use Illuminate\Support\Facades\View;
use App\Models\Humanresource\Holiday;
use Illuminate\Support\Facades\Blade;
use App\Models\Humanresource\Employee;
use Illuminate\Support\ServiceProvider;
use App\Models\Humanresource\Suggestion;

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
        View::share('facilityInfo', FacilityInformation::first());
        View::share('birthdays', Employee::whereMonth('birthday', date('m'))->whereDay('birthday', date('d'))->latest()->get());
        View::share('holidays', Holiday::whereMonth('start_date', '=', date('m'))->whereDay('start_date', '=', (date('d') + 1))->get());
        View::share('suggestions', Suggestion::latest()->get());
        View::share('departments', Department::where(['status' => 'Active', 'type' => 'Unit'])->orWhere('type', 'Laboratory')->latest()->get());


            Blade::directive('moneyFormat', function ($figure) {
                return "<?php echo number_format($figure,2); ?>";
            });
    
            Blade::directive('numberFormat', function ($figure) {
                return "<?php echo number_format($figure); ?>";
            });
    
            Blade::directive('formatDate', function ($expression) {
                return "<?php echo date('d-M-Y', strtotime($expression)); ?>";
            });
    
            Blade::directive('formatDateTime', function ($date) {
                return "<?php echo date('d-M-Y H:i', strtotime($date)); ?>";
            });
        }
    
}
