<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ActivityLaunchesSend extends Notification
{
    use Queueable;

    private $data;

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
        $html = '<table style="width: 100%;">';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<th>N.</th>';
        $html .= '<th>Semana</th>';
        $html .= '<th>Receber</th>';
        $html .= '<th>Descontar</th>';
        $html .= '<th>Acerto</th>';
        $html .= '<th>Total</th>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';
        foreach ($this->data as $value) {
            $html .= '<tr>';
            $html .= '<td style="border-bottom: solid 1px #cccccc; text-align: center;">' . $value['number'] . '</td>';
            $html .= '<td style="border-bottom: solid 1px #cccccc; text-align: center;">' . $value['start_date'] . '<br>' . $value['end_date'] . '</td>';
            $html .= '<td style="border-bottom: solid 1px #cccccc; text-align: center;">' . $value['sum'] . '</td>';
            $html .= '<td style="border-bottom: solid 1px #cccccc; text-align: center;">' . $value['sub'] . '</td>';
            $html .= '<td style="border-bottom: solid 1px #cccccc; text-align: center;">' . $value['refund'] . '</td>';
            $html .= '<td style="border-bottom: solid 1px #cccccc; text-align: center;">' . $value['total'] . '</td>';
            $html .= '</tr>';
        }
        $html .= '</tbody>';
        $html .= '</table>';

        return (new MailMessage)
                    ->subject('Extrato ExpertCom')
                    ->greeting('Olá!')
                    ->line('O ExpertCom o extrato abaixo.')
                    ->line($html)
                    ->line('Visite a sua área pessoal para verificar os detalhes e fazer upload do recibo.')
                    ->action('Área pessoal', url('https://expertcom.pt/login'))
                    ->line('Obrigado pela preferência')
                    ->salutation('Equipa ExpertCom');
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
