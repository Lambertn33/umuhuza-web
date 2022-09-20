<?php

namespace App\Jobs\SMS\Client;

use App\Http\Services\Common\SendSMS;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FileProcessed implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $client;
    public $file;
    public $notary;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($client, $file, $notary)
    {
        $this->file = $file;
        $this->client = $client;
        $this->notary = $notary;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $message = 'Dear '.$this->client->user->names.' a file with code '.$this->file->file->file_number.' has been processed successfully by ' .$this->notary->user->names.' ';
        (new SendSMS)->sendSMS($this->client->user, $message);
    }
}
