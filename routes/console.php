<?php

use App\Models\Emprestimo;
use App\Models\User;
use App\Notifications\LembreteEmprestimoVence;
use Carbon\Carbon;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::call(function () {
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

