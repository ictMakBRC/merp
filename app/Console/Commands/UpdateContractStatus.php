<?php

namespace App\Console\Commands;

use App\Models\Humanresource\Employee;
use App\Models\Humanresource\OfficialContract;
use App\Models\Humanresource\ProjectContract;
use App\Notifications\ContractExpiryNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateContractStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'contract:update-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the status of official and project contracts';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $today = Carbon::today()->format('Y-m-d');
        $next_date = Carbon::today()->addDays(90)->format('Y-m-d');

        //SELECT CONTRACT THAT ARE EXPIRING IN THE NEXT 90 DAYS
        $officialContractsExpiringSoon = OfficialContract::addSelect(['emp_id' => Employee::select('emp_id')->whereColumn('employee_id', 'employees.id'),
            'surname' => Employee::select('surname')->whereColumn('employee_id', 'employees.id'),
            'other_name' => Employee::select('other_name')->whereColumn('employee_id', 'employees.id'),
            'first_name' => Employee::select('first_name')->whereColumn('employee_id', 'employees.id'),
            'prefix' => Employee::select('prefix')->whereColumn('employee_id', 'employees.id'),
            DB::raw('DATEDIFF(end_date,CURRENT_DATE()) as days_to_expire'),
        ])->where('status', 'Running')->whereBetween('end_date', [$today, $next_date])->get();

        $projectContractsExpiringSoon = ProjectContract::addSelect([
            'emp_id' => Employee::select('emp_id')->whereColumn('employee_id', 'employees.id'),
            'surname' => Employee::select('surname')->whereColumn('employee_id', 'employees.id'),
            'other_name' => Employee::select('other_name')->whereColumn('employee_id', 'employees.id'),
            'first_name' => Employee::select('first_name')->whereColumn('employee_id', 'employees.id'),
            'prefix' => Employee::select('prefix')->whereColumn('employee_id', 'employees.id'),
            DB::raw('DATEDIFF(end_date,CURRENT_DATE()) as days_to_expire'),
        ])->with('position', 'project')->where('status', 'Running')->whereBetween('end_date', [$today, $next_date])->get();

        //MARK STATUS OF EXPIRED CONTRACTS TO EXPIRED
        if (OfficialContract::where('status', 'Running')->where('end_date', '<', $today)->update(['status' => 'Expired']) ||
            ProjectContract::where('status', 'Running')->where('end_date', '<', $today)->update(['status' => 'Expired'])) {
            $this->info(date('Y-m-d').' Contract Status Updated Successfull');
        } else {
            $this->info(date('Y-m-d').' Contract Status upto date');
        }
        //SEND OFFICIAL CONTRACT EXPIRY NOTIFICATION
        if (! $officialContractsExpiringSoon->isEmpty()) {
            foreach ($officialContractsExpiringSoon as $contract) {
                if ($contract->days_to_expire === 30 || $contract->days_to_expire === 60 || $contract->days_to_expire === 90) {
                    $greeting = 'Hello'.' '.$contract->surname;
                    $body = 'This is a reminder that your Official MakBRC
                    contract will expire in '.$contract->days_to_expire.' days. Please follow  up on the renewal process';

                    $details = [
                        'greeting' => $greeting,
                        'body' => $body,
                    ];

                    $contract->employee->notify(new ContractExpiryNotification($details));
                    $this->info(date('Y-m-d').' Official Contract Expiry Notification sent to '.$contract->surname);
                }
            }
        } else {
            return 0;
        }

        //SEND PROJECT CONTRACT EXPIRY NOTIFICATION
        if (! $projectContractsExpiringSoon->isEmpty()) {
            foreach ($projectContractsExpiringSoon as $contract) {
                if ($contract->days_to_expire === 30 || $contract->days_to_expire === 60 || $contract->days_to_expire === 90) {
                    $greeting = 'Hello'.' '.$contract->surname;
                    $body = 'This is a reminder that your '.$contract->project->department_name.' Project
                    contract as '.$contract->position->name.' will expire in '.$contract->days_to_expire.' days. Please follow  up';

                    $details = [
                        'greeting' => $greeting,
                        'body' => $body,
                    ];

                    $contract->employee->notify(new ContractExpiryNotification($details));
                    $this->info(date('Y-m-d').' Project Contract Expiry Notification sent to '.$contract->surname);
                }
            }
        } else {
            return 0;
        }
    }
}
