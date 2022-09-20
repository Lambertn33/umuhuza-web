<?php

namespace App\Jobs\SMS\Common;

use App\Http\Services\Common\SendSMS;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FileAccessRequest implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $names;
    public $telephone;
    public $file;
    public $notary;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($names, $telephone, $file, $notary)
    {
        $this->names = $names;
        $this->telephone = $telephone;
        $this->file = $file;
        $this->notary = $notary;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
       $file =  $this->file;
       $names = $this->names;
       $notary = $this->notary;
       $telephone = $this->telephone;
       $message = 'Dear '.$notary->user->names.' you have received the file access request of file with code '.$file->file_number.' by ' . $names . ' with telephone number ' .$telephone. '';
       (new SendSMS)->sendSMS($notary->user, $message);
    }
}
