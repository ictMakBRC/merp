<?php

namespace App\Jobs\DocumentManagement;

use App\Mail\DocumentManagement\SendDocEmailNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendEmailNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $details;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($referral_request)
    {
        $this->details = $referral_request;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->details['to'])->send(new SendDocEmailNotification($this->details));
    }

    public function failed(\Exception $exception)
    {
        Log::error('Failed to send referral status email. Error message: '.$exception->getMessage());
    }
}
