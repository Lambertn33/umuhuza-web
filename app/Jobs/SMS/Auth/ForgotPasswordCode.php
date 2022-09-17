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
        $message = 'Dear '.$this->user->names.' the code '. $this->code .' is for resetting your password';
        Http::withHeaders([
            'Authorization' => 'Bearer '.env("SMS_TOKEN").'',
        ])->acceptJson()
        ->post(''.env("SMS_URL").'', [
            'sender' => 'E-HUZA',
            'to' => '+'.$this->user->telephone,
            'text' => $message
        ]);
    }
}
