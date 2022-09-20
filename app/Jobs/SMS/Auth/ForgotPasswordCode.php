<?php

namespace App\Jobs\SMS\Auth;

use App\Http\Services\Common\SendSMS;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class ForgotPasswordCode implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    
    public $user;
    public $code;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user, $code)
    {
        $this->user = $user;
        $this->code = $code;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user = $this->user;
        $code = $this->code;

        $message = 'Dear '.$user->names.' the code '. $code .' is for resetting your password';
        (new SendSMS)->sendSMS($user, $message);
    }
}
