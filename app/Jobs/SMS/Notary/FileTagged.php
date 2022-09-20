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
        $message = 'Dear '.$this->notary->user->names.' a file with code '.$this->fileCode.' has been sent to you by '.$this->client->user->names.' and it is waiting to be processed';
        (new SendSMS)->sendSMS($this->notary->user, $message);
    }
}
