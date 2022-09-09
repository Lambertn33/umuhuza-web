<?php

namespace App\Listeners;

use App\Events\ClientRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;
use App\Models\Client;

class ClientRegisteredListener
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
     * @param  \App\Events\ClientRegistered  $event
     * @return void
     */
    public function handle(ClientRegistered $event)
    {
        $user = $event->user;
        $client = $event->client;
        User::insert($user);
        Client::insert($client);

    }
}
