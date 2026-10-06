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
     * Pega a notificação
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Pega o email da notficação.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('O Emprestimo do livro vence em 2 dias.')
            ->action('Ver Emprestimo', url('/'))
            ->line('Obrigado pela atenção!');
    }

    /**
     * Pega o array da notificação
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
