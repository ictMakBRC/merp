<?php

namespace App\Console\Commands;

use App\Models\Humanresource\Employee;
use App\Models\Humanresource\Holiday;
use App\Notifications\HolidayNotification;
use Illuminate\Console\Command;

class SendHolidayAlerts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'holiday:send-notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Holiday alerts to employees';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // $day = Carbon::today()->addDays(1)->day;
        // $month = Carbon::today()->month;
        $holiday = Holiday::whereMonth('start_date', '=', date('m'))->whereDay('start_date', '=', date('d') + 1)->first();
        $employees = Employee::where('status', 'Active')->get();

        if ($holiday) {
            foreach ($employees as $employee) {
                $greeting = 'Hello'.' '.$employee->fullName;
                $body = 'This is a reminder that tommorow is a '.$holiday->holiday_type.' ('.$holiday->title.'). Please Enjoy your Holiday(s)';

                $details = [
                    'greeting' => $greeting,
                    'body' => $body,
                ];

                $employee->notify(new HolidayNotification($details));
            }

            $this->info(date('Y-m-d').' '.$holiday->name.' Holiday Notification sent successfully');
        } else {
            return 0;
        }
    }
}
