<?php

namespace App\Jobs\SMS\Notary;

use App\Http\Services\Common\SendSMS;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FileTagged implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $client;
    public $notary;
    public $fileCode;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($client, $notary, $fileCode)
    {
        $this->notary = $notary;
        $this->client = $client;
        $this->fileCode = $fileCode;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $notary = $this->notary;
        $client = $this->client;
        $fileCode = $this->fileCode;

        $message = 'Dear '.$notary->user->names.' a file with code '.$fileCode.' has been sent to you by '.$client->user->names.' and it is waiting to be processed';
        (new SendSMS)->sendSMS($notary->user, $message);
    }
}
