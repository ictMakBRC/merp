<?php

namespace App\Jobs\HumanResource;

use Carbon\Carbon;
use Dompdf\Dompdf;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\File;
use App\Models\Humanresource\Employee;
use Illuminate\Queue\SerializesModels;
use App\Models\Settings\GeneralSetting;
use Illuminate\Support\Facades\Storage;
use App\Mail\HumanResource\PayslipEmail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\Humanresource\ProjectContract;
use App\Models\Humanresource\BankingInformation;

class SendProjectPaySlip implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
   
     protected $employeeIds;
     protected $employees;
     protected $month;
     protected $global;

     public function __construct(array $employeeIds)
     {
        $this->month = Carbon::today()->format('Y-m-d');;
        $this->global = GeneralSetting::latest()->first();

        $this->employees  = ProjectContract::with('employee','project','position')->whereIn('id', $employeeIds)->first();
      
        // $this->employees = Employee::with(['designation','department','departmentunit','officialContract','bankAccts'])->whereIn('id', $employeeIds)->get();
     }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // return $this->employees;
        foreach($this->employees as $employee){

                // Create a new Dompdf instance
            $dompdf = new Dompdf();

             $bank_account = BankingInformation::where(['employee_id'=> $employee->employee_id, 'is_default'=>1])->latest()->first();
            if(!$bank_account){            
                $bank_account = BankingInformation::where('employee_id', $employee->employee_id)->latest()->first();
            }
            $user = Employee::where('id', $employee->employee_id)->first();
            // Generate the PDF content from payslip.blade.php
            $data = [
                'employee' => $employee,
                'global' => $this->global,
                'month' => $this->month,
                'bank_account' => $bank_account,
            ];
// return $data;
            $html = view('emails.project-pay-slip', $data)->render();
            $dompdf->loadHtml($html);
            $dompdf->render();
    
            // Save the PDF to a file
            $pdfOutput = $dompdf->output();
            $filename=$employee->employee->emp_id.'.pdf';
            // Create the directory if it doesn't exist

            // Save the PDF to the storage disk
            Storage::disk('local')->put('payslips/project/' . $filename, $pdfOutput);
            // Get the path to the saved PDF file
            $pdfPath = Storage::disk('local')->path('payslips/project/' . $filename);
    
            // Send the PDF via email
            $greeting = 'Hello'.' '.$employee->employee->fullName;
            $body = 'Please find attached your Payslip for your verification';
            $actiontext = 'Click to Login';

            $details = [
                'greeting' => $greeting,
                'body' => $body,
                'actiontext' => $actiontext,
                'actionurl' => config('app.url'),
                'payslip_path'=>$pdfPath
            ];
            // dd($details);
            // $email = $employee->email;
            $user->notify(new PayslipEmail($details));
 
            // Clean up the generated PDF file
            unlink($pdfPath);
        }
        
    }
}
