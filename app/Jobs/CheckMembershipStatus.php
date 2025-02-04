<?php

namespace App\Jobs;

use App\Models\Membership;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class CheckMembershipStatus implements ShouldQueue
{
    use Queueable;

    public $timeout = 120;
    public $tries = 3;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Membership::where('active', true)
            ->where('end_date', '<', now()->toDateString())
            ->chunk(100, function ($memberships) {
                foreach ($memberships as $membership) {
                    $membership->update(['active' => false]);
                }
            });
    }
}
