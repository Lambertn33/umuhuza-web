<?php

namespace App\Listeners;

use App\Events\NotaryRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;
use App\Models\Notary;

class NotaryRegisteredListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\NotaryRegistered  $event
     * @return void
     */
    public function handle(NotaryRegistered $event)
    {
        $user = $event->user;
        $notary = $event->notary;
        User::insert($user);
        Notary::insert($notary);

        //TODO
        //Send SMS for waiing the Approval from the Admin
    }
}
