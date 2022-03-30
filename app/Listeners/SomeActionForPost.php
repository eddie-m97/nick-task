<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;

class SomeActionForPost implements ShouldQueue
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
     * @param object $event
     * @return void
     */
    public function handle($event)
    {
        // I didn't find a reason to use events for this task.
    }
}
