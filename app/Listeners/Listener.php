<?php

namespace App\Listeners;

use App\Events\Event;

class Listener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct() { }

    /**
     * Handle the event.
     *
     * @param Event $event
     * @return void
     */
    public function handle(Event $event) { }
}
