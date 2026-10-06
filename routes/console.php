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

<?php
use App\Models\Emprestimo;
use App\Notifications\LembreteEmprestimoVence;
use Illuminate\Support\Facades\Schedule;
Schedule::call(function () {
    $emprestimos = Emprestimo::where('data_devolucao', now()->addDays(2)->toDateString())
        ->where('lembrete_enviado', false)
        ->get();
    foreach ($emprestimos as $emprestimo) {
        if ($emprestimo->user) {
            $emprestimo->user->notify(new LembreteEmprestimoVence($emprestimo));
            $emprestimo->update(['lembrete_enviado' => true]);
        }
        }
        })->daily()->description('Enviar lembrete de empréstimos que vencem em 2 dias');

