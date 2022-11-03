<?php

namespace App\Console\Commands;

use App\Helpers\GenerateBirthdayWish;
use App\Models\Humanresource\Employee;
use App\Notifications\BirthdayNotification;
use Illuminate\Console\Command;

class SendBirthdayWishes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'birthday:sendwishes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Birthday wishes to employees';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $employees = Employee::whereMonth('birthday', '=', date('m'))->whereDay('birthday', '=', date('d'))->where('status', 'Active')->get();

        if (! $employees->isEmpty()) {
            foreach ($employees as $employee) {
                $employee->notify(new BirthdayNotification($employee->fullName, GenerateBirthdayWish::generate()));
                $this->info(date('Y-m-d').' Birthday messages sent successfully to '.$employee->fullName);
            }
        } else {
            $this->info(date('Y-m-d').' No employee has a birthday today');

            return 0;
        }
    }
}
