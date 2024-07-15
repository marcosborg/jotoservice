<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class carRentalContact extends Notification
{
    use Queueable;

    private $CarRentalContactRequest;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($CarRentalContactRequest)
    {
        $this->CarRentalContactRequest = $CarRentalContactRequest;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('Existe um pedido de contacto em Aluguer de viaturas.')
                    ->action('Ir para pedido', url('http://expertcom.pt/admin/car-rental-contact-requests'))
                    ->line('Nome: ' . $this->CarRentalContactRequest->name)
                    ->line('Email: ' . $this->CarRentalContactRequest->email)
                    ->line('Telefone: ' . $this->CarRentalContactRequest->phone);
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
