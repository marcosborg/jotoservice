<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class courierContact extends Notification
{
    use Queueable;

    private $CourierForm;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($CourierForm)
    {
        $this->CourierForm = $CourierForm;
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
                    ->line('Existe um pedido de contacto em Estafetas.')
                    ->action('Ir para pedido', url('http://expertcom.pt/admin/courier-forms'))
                    ->line('Nome: ' . $this->CourierForm->name)
                    ->line('Email: ' . $this->CourierForm->email)
                    ->line('Telefone: ' . $this->CourierForm->phone);
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
