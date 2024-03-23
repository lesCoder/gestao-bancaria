<?php

namespace Tests\Feature;

use App\Models\Conta;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class transacaoTest extends TestCase
{

    use RefreshDatabase;

    public function testTransacaoSaldoInsuficiente(): void
    {
        $conta = Conta::factory()->create();

        $payload = [
            'forma_pagamento' => 'D',
            'conta_id' => $conta->id,
            'valor' => $conta->saldo + 1
        ];

        $this->json('post', 'api/transacao', $payload)
            ->assertStatus(Response::HTTP_NOT_FOUND);
        //->assertJson([
        //    'conta_id' => 1234,
        //    'saldo' => 189.70
        //]);
    }

    public function testTransacaoFormaDePagamentoIncorreta(): void
    {
        $conta = Conta::factory()->create();

        $payload = [
            'forma_pagamento' => 'X',
            'conta_id' => $conta->id,
            'valor' => 10
        ];

        $this->json('post', 'api/transacao', $payload)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function testTransacaoComContaInexistente(): void
    {
        $payload = [
            'forma_pagamento' => 'D',
            'conta_id' => 999,
            'valor' => 10
        ];

        $this->json('post', 'api/transacao', $payload)
            ->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function testTransacaoComValorNegativo(): void
    {
        $conta = Conta::factory()->create();
        $payload = [
            'forma_pagamento' => 'D',
            'conta_id' => $conta->id,
            'valor' => -10
        ];

        $this->json('post', 'api/transacao', $payload)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function testTransacaoBemSucedida(): void
    {
        $conta = Conta::factory()->create();

        $payload = [
            'forma_pagamento' => 'D',
            'conta_id' => $conta->id,
            'valor' => 10
        ];

        $this->json('post', 'api/transacao', $payload)
            ->assertStatus(Response::HTTP_OK);
        //->assertJson([
        //    'conta_id' => 1234,
        //    'saldo' => 189.70
        //]);
    }

    

}
