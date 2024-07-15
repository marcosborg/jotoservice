<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class trainingContact extends Notification
{
    use Queueable;

    private $trainingForm;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($trainingForm)
    {
        $this->trainingForm = $trainingForm;
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
                    ->line('Existe um pedido de contacto em Formação.')
                    ->action('Ir para pedido', url('http://expertcom.pt/admin/training-forms'))
                    ->line('Nome: ' . $this->trainingForm->name)
                    ->line('Email: ' . $this->trainingForm->email)
                    ->line('Telefone: ' . $this->trainingForm->phone);
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
