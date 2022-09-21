<?php

namespace App\Jobs\SMS\Notary;

use App\Http\Services\Common\SendSMS;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FileAccessApproved implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $fileAccessRequest;
    public $accessCode;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($fileAccessRequest, $accessCode)
    {
        $this->accessCode = $accessCode;
        $this->fileAccessRequest = $fileAccessRequest;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $fileAccessRequest = $this->fileAccessRequest;
        $accessCode = $this->accessCode;
        $message = 'Dear '.$fileAccessRequest->requested_by.' your request of access to file #'.$fileAccessRequest->file->file_number.' has been approved with access code of '. $accessCode .' ';
        (new SendSMS)->approveFileAccessRequest($fileAccessRequest->telephone, $message);
    }
}
