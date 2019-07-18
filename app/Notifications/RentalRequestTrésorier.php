<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
;

class RentalRequestTrésorier extends Notification implements ShouldQueue
{
    use Queueable;

    protected $event;
    protected $booking;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($event)
    {
        $this->event=$event;

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

            ->subject('bouvelle reservation validé')
            ->greeting('bonjour')
            ->line('une nouvelle réservation à été validé avec la communication : '.$this->event->communication.' et le montant du virement est de : '.$this->event->tarif.'.')
            ->line('une fois le payement reçu veuillé cliquer sur le boutons ci-dessus pour valider le payement ')
            ->action('valider payement', url($url));

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
            'booking'=>$this->booking,
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
