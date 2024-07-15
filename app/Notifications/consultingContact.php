<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class consultingContact extends Notification
{
    use Queueable;

    private $ConsultingForm;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($ConsultingForm)
    {
        $this->ConsultingForm = $ConsultingForm;
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
                    ->line('Existe um pedido de Consultadora TVDE.')
                    ->action('Ir para pedido', url('http://expertcom.pt/admin/consulting-forms'))
                    ->line('Nome: ' . $this->ConsultingForm->name)
                    ->line('Email: ' . $this->ConsultingForm->email)
                    ->line('Telefone: ' . $this->ConsultingForm->phone);
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
