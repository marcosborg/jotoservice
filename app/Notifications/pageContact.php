<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class pageContact extends Notification
{
    use Queueable;

    private $PageForm;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($PageForm)
    {
        $this->PageForm = $PageForm;
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
                    ->line('Existe um pedido de contacto.')
                    ->action('Ir para pedido', url('http://expertcom.pt/admin/page-forms'))
                    ->line('Nome: ' . $this->PageForm->name)
                    ->line('Email: ' . $this->PageForm->email)
                    ->line('Telefone: ' . $this->PageForm->phone);
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
