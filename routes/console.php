<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Models\Emprestimo;
use App\Notifications\LembreteEmprestimoVence;
use Carbon\Carbon;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::call(function (){
$dataAlvo = Carbon::now()->addDays(2)->toDateString();

$emprestimos = Emprestimo::whereDate('data_devolucao', $dataAlvo)
        ->where('lembrete_enviado', false)
        ->get();
foreach ($emprestimos as $emprestimo) {
        if ($emprestimo->user) {
            $emprestimo->user->notify(new LembreteEmprestimoVence($emprestimo));
            $emprestimo->update(['lembrete_enviado' => true]);
            }


}

})->daily()->description('Enviar lembrete de empréstimos que vencem em 2 dias');


Artisan::command('testar:email', function () {
    $user = \App\Models\User::first();

    if ($user) {
        $user->notify(new \App\Notifications\LembreteEmprestimoVence());
        $this->info('E-mail de teste enviado com sucesso!');
    } else {
        $this->error('Nenhum usuário encontrado no banco de dados!');
    }
})->description('Enviar e-mail de teste diretamente para o Mailtrap');
