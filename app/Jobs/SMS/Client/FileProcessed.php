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
       $file =  $this->file->file;
       $client = $this->client;
       $notary = $this->notary;
       $message = 'Dear '.$client->user->names.' a file with code '.$file->file_number.' has been processed successfully by ' .$notary->user->names.' ';
       (new SendSMS)->sendSMS($client->user, $message);
    }
}
