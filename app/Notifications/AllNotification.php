<?php

namespace App\Notifications;

// use App\Channels\SmsNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class AllNotification extends Notification
{
    use Queueable;

    public $data;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return array_key_exists('mail', $this->data) ? ['database', 'mail'] : ['database'];
        // return ['database', 'mail', 'broadcast', SmsNotification::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // return (new MailMessage)
        //             ->line('The introduction to the notification.')
        //             ->action('Notification Action', url('/'))
        //             ->line('Thank you for using our application!');
        $send =  (new MailMessage)
            ->subject($this->data['subject'])
            ->markdown('mail.notification', ['data' => $this->data]);

        return array_key_exists('attach', $this->data) ? $send->attach($this->data['file']) : $send;
        
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'title' => $this->data['title'],
            'content' => $this->data['content'],
            'url' => $this->data['url'],
        ];
    }

    public function toSms($notifiable)
    {
        return [
            'sms' => $this->data['sms'],
        ];
    }

    // public function toBroadcast($notifiable)
    // {
    //     return new BroadcastMessage([
    //         'title' => $this->data['title'],
    //         'content' => $this->data['content'],
    //         'url' => $this->data['url']
    //     ]);
    // }

    // public function toDatabase($notifiable)
    // {
    //     return [
    //         'title' => $this->data['title'],
    //         'content' => $this->data['content'],
    //         'url' => $this->data['url']
    //     ];
    // }

}
