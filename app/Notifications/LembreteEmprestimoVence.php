<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LembreteEmprestimoVence extends Notification
{
    use Queueable;

    public $emprestimos;

    /**
 * Notificação para lembrar o utilizador sobre o vencimento de empréstimo.
 */
    public function __construct($emprestimos = null)
    {
        $this->emprestimos = $emprestimos;
    }

    /**
     * Esses comentrios ja vem quando vc baixa o Notification pelo artisan ta
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('O Emprestimo do livro vence em 2 dias.')
            ->action('Ver Emprestimo', url('/'))
            ->line('Obrigado pela atenção!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
