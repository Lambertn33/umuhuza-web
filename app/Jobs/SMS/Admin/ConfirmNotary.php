<?php

namespace App\Jobs\SMS\Admin;

use App\Http\Services\Common\SendSMS;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ConfirmNotary implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;
    public $oneTimePassword;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user, $oneTimePassword)
    {
        $this->user = $user;
        $this->oneTimePassword = $oneTimePassword;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user = $this->user;
        $password = $this->oneTimePassword;
        $message = 'Dear '.$user->names.' your application as a notary has been reviewed and accepted.. please use '. $password .' as your one time password login ';
        (new SendSMS)->sendSMS($this->user, $message);
    }
}
