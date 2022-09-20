<?php

namespace App\Jobs\SMS\Notary;

use App\Http\Services\Common\SendSMS;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UsersConfirmFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $file;
    public $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($file, $user)
    {
        $this->file = $file;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $message = 'Dear '.$this->user['names']. ' the code '. $this->user['confirmation_code']. ' is to confirm the file #'. $this->file->file_number .'';
        (new SendSMS)->sendSMS($this->user, $message);
    }
}
