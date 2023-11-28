<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReferralEmail extends Mailable
{
    use SerializesModels;

    private $userData;

    private $introducerName;

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
