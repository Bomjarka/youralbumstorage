<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FeedbackEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $emailFrom;

    public $isFromGuest;

    public $userMessage;

    public $user;

    public $fromName;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $email, string $userMessage, string $name = null, User $user = null, $isFromGuest = true)
    {
        $this->user = $user;
        $this->fromName = $name;
        $this->emailFrom = $email;
        $this->isFromGuest = $isFromGuest;
        $this->userMessage = $userMessage;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->isFromGuest) {
            return $this->from(config('mail.from.address', 'YourAlbumStorage'))
                ->subject('Feedback message from guest ' . $this->emailFrom)
                ->view('letters.letter', ['emailFrom' => $this->emailFrom, 'userMessage' => $this->userMessage]);
        }

        return $this->from(config('mail.from.address', 'YourAlbumStorage'))
            ->subject('Feedback message from user' . $this->emailFrom)
            ->view('letters.letter', ['user' => $this->user, 'fromName' => $this->fromName, 'emailFrom' => $this->emailFrom, 'userMessage' => $this->userMessage]);

    }
}
