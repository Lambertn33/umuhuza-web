<?php

namespace App\Jobs\SMS\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class ConfirmRegistration implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;
    public $oneTimePassword;
    public $isClient;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user, $oneTimePassword, $isClient)
    {
        $this->user = $user;
        $this->oneTimePassword = $oneTimePassword;
        $this->isClient = $isClient;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $message = '';
        $user= $this->user;
        if ($this->isClient) {
            $message = 'Dear '. $user['names'] . ' Thanks for applying as a client... please use '. $this->oneTimePassword .' as your one time password login ';
        } else {
            $message = 'Notary';
        }
        Http::withHeaders([
            'Authorization' => 'Bearer eyJhbGciOiJub25lIn0.eyJpZCI6NDczLCJyZXZva2VkX3Rva2VuX2NvdW50IjowfQ.',
        ])->acceptJson()
        ->post('https://api.pindo.io/v1/sms/', [
            'sender' => 'E-HUZA',
            'to' => $user['telephone'],
            'text' => $message
        ]);
    }
}
