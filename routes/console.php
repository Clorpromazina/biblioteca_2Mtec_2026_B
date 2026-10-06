<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::call(function (){
$dataAlvo = carbon::now()=>addDays(2)->toDateString();

$emprestimos = Emprestimo::whereDate('data_devolucao', $dataAlvo)
        ->where('lembrete_enviado', false)
        ->get();
foreach ($emprestimos as $emprestimo) {
        if ($emprestimo->user) {
            $emprestimo->user->notify(new LembreteEmprestimoVence($emprestimo));
            $emprestimo->update(['lembrete_enviado' => true]);
            }


})->daily()->purpose('Enviar lembrete de empréstimos que vencem em 2 dias');