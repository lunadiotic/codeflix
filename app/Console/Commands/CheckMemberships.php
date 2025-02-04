<?php

namespace App\Console\Commands;

use App\Jobs\CheckMembershipStatus;
use Illuminate\Console\Command;

class CheckMemberships extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'memberships:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check and deactivate expired memberships';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        CheckMembershipStatus::dispatch();
        $this->info('Membership check job has been dispatched');
    }
}
