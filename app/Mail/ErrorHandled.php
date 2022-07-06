<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ErrorHandled extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var
     */
    public $error;
    private string $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($error, string $url)
    {
        $this->url = $url;
        $this->error = $error;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): ErrorHandled
    {
        return $this->from(config('mail.from.address', 'YourAlbumStorage'))
            ->subject('Error log')
            ->view('letters.error', ['error' => $this->error, 'url' => $this->url]);
    }
}
