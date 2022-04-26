<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\URL;

class DownloadPhotosNotification extends Notification
{
    use Queueable;

    public $file;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($file)
    {
        $this->file = $file;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('You are receiving this email because we received a request for downloading all photos from you.')
            ->action('Click here to download your archive', $this->downloadFileUrl($notifiable))
            ->line('Thank you for using our application!');
    }


    protected function downloadFileUrl($notifiable)
    {
        $fileName = Arr::last(explode('/', $this->file));

        return URL::temporarySignedRoute(
            'download',
            Carbon::now()->addMinutes(5),
            [
                'id' => $notifiable->getKey(),
                'notification' => $this->id,
                'filename' => $fileName,
            ]
        );
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'email' => $notifiable->email,
            'message' => 'Link for download photos sent!'
        ];
    }
}
