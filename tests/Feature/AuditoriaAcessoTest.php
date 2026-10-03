<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuditoriaAcessoTest extends TestCase
{
    use RefreshDatabase;

    public function test_visitante_e_mandado_para_o_login(): void
    {
        $this->get('/auditoria')->assertRedirect('/login');
    }

    public function test_usuario_comum_recebe_403(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->get('/auditoria')->assertForbidden();
    }

    public function test_administrador_da_lista_ve_a_tela(): void
    {
        $admin = User::factory()->create();
        config(['auditoria.administradores' => [$admin->email]]);

        $this->actingAs($admin)->get('/auditoria')->assertOk();
    }
}