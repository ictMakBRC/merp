<?php

namespace App\Console\Commands;

use App\Models\Humanresource\Notice;
use Illuminate\Console\Command;

class DeleteExpiredNotice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notice:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if (Notice::where('expires_on', '<', date('Y-m-d'))->delete()) {
            return 0;
        } else {
            return 0;
        }
    }
}
