<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReferralEmail extends Mailable
{
    use SerializesModels;

    private $userData;
    private $introducerName;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userData, $introducerName)
    {
        $this->userData = $userData;
        $this->introducerName = $introducerName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Your Buddy Joined to VENTURA')
                ->view('_mail.referral')
                ->with('userData', $this->userData)
                ->with('introducerName', $this->introducerName);
    }
}
