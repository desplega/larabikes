<?php

namespace App\Listeners;

use App\Events\FirstBikeCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\Congratulations;

class SendCongratulationsEmail
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
     * @param  \App\Events\FirstBikeCreated  $event
     * @return void
     */
    public function handle(FirstBikeCreated $event)
    {
        Mail::to($event->user->email)->send(new Congratulations($event->bike, $event->user));
    }
}
