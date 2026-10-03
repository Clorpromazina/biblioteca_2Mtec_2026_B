# Auditoria de alterações

## Decisão: tabela própria (e não o pacote `spatie/laravel-activitylog`)

| Critério | Pacote spatie | Tabela própria |
|---|---|---|
| Dependência nova | Sim (`composer require`) | Não |
| Funciona com nossas tabelas/colunas em MAIÚSCULAS | Precisa de configuração extra | Já nasce no nosso padrão |
| Complexidade para o time aprender | Maior (muita "mágica") | Menor (~100 linhas que todos conseguem ler) |
| Atende ao critério "usuário, data e o que mudou" | Sim | Sim |

**Escolha:** tabela própria `AUDITORIAS`, alimentada pela trait `Auditavel`.

## Como usar em um model

```php
use App\Models\Concerns\Auditavel;

class Livro extends Model
{
    use Auditavel;
}
```

Pronto: criar, editar e excluir esse model passa a gerar uma linha em `AUDITORIAS`.

## Limitação conhecida

Só são registradas alterações feitas via Eloquent (`$livro->save()`, `->update()`,
`->delete()`). Alterações em massa via `DB::table(...)` ou `Livro::where(...)->update(...)`
não disparam eventos e, portanto, não são auditadas.

## Quem pode ver

Apenas usuários com `is_admin = true` (Gate `ver-auditoria`, em `AppServiceProvider`).
Tela em `/auditoria`.
