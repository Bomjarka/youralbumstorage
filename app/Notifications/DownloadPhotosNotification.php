<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
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
     * Уведомление с ссылкой на скачивание файла
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable): array
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
            ->subject(trans('download-photo-email-message.subject'))
            ->greeting(trans('verify-email-message.greeting') . ', ' . strtoupper($notifiable->fullName()))
            ->line(trans('download-photo-email-message.message'))
            ->action(trans('download-photo-email-message.action'), $this->downloadFileUrl($notifiable))
            ->line(trans('email.link-lifetime', ['period' => config('links.email.lifetime')]))
            ->salutation(trans('verify-email-message.regards'));
    }


    /**
     *
     * Ссылка на скачивание файла
     *
     * @param $notifiable
     * @return string
     */
    protected function downloadFileUrl($notifiable): string
    {
        $fileName = Arr::last(explode('/', $this->file));

        return URL::temporarySignedRoute(
            'download',
            Carbon::now()->addMinutes(config('links.email.lifetime')),
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
            'message' => 'Link for download photos sent!',
            'link' => $this->downloadFileUrl($notifiable),
        ];
    }
}
