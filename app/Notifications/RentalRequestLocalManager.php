<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class RentalRequestLocalManager extends Notification implements ShouldQueue
{
    use Queueable;

    protected $event;
    protected $locataire;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($event,$locataire)
    {
        $this->event=$event;
        $this->locataire=$locataire;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
//        return ['mail'];
        return['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {   $url=secure_url('/event/',[$this->event['id']]);
        return (new MailMessage)

            ->subject('nouvelle demande de location')
            ->greeting('bonjour')
            ->line($this->locataire['firstname'].' '.$this->locataire['name'].' a introduit une nouvelle demande de location.')
            ->action('voir', url($url));

    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {

        return [
            'event'=>$this->event,
            'user'=>$notifiable,
            'locataire'=>$this->locataire,
            'repliedTime'=>Carbon::now()
        ];
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
            //
        ];
    }
}
