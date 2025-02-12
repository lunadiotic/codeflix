<?php

namespace App\Jobs;

use App\Events\MembershipHasExpired;
use App\Models\Membership;
use Illuminate\Bus\Batchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CheckMembershipStatus implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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

                    event(new MembershipHasExpired($membership));
                }
            });
    }
}
