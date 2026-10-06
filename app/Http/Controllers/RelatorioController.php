<?php

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

public function atrasospdf()
{
    $atrasos = DB::table('EMPRESTIMOS')
        ->join('LIVROS', 'EMPRESTIMOS.EMPLIVRO', '=', 'LIVROS.LVRCODIGO')
        ->join('CLIENTES', 'EMPRESTIMOS.EMPCLIENTE', '=', 'CLIENTES.CLICODIGO')
        ->select('EMPRESTIMOS.*', 'LIVROS.LVRNOME', 'CLIENTES.CLINOME')
        ->whereNull('EMPRESTIMOS.EMPDTDEVOL')
        ->whereDate('EMPRESTIMOS.EMPDTEMPR', '<', now()->subDays(7))
        ->orderBy('EMPRESTIMOS.EMPDTEMPR')
        ->get();

    $pdf = Pdf::loadView('relatorios.atrasos', ['atrasos' => $atrasos]);
    return $pdf->download('relatorio_atrasos.pdf');
}
