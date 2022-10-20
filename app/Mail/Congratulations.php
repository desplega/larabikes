<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Bike;
use App\Models\User;
use Carbon\Traits\Serialization;

class Congratulations extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Bike $bike, public User $user)
    {
    }

    public function build()
    {
        return $this->from('no-reply@larabikes.com')
            ->subject('¡Felicidades!')
            ->view('emails.congratulations');
    }
}
