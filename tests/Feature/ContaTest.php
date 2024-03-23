<?php

namespace Tests\Feature;

use App\Models\Conta;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;

use Tests\TestCase;

class ContaTest extends TestCase
{

    use RefreshDatabase;

    private $payload = [
        'numero_conta'  => 123456789,
        'valor'      => 100.00
    ];

    public function test_criacao_de_conta(): void
    {

        $this->json('post', 'api/conta', $this->payload)
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure(
                [
                    'conta' => [
                        'numero_conta',
                        'saldo',
                    ]
                ]
            );
    }

    public function test_criacao_de_conta_valor_negativo(): void
    {
        $dadosConta = [
            'numero_conta'  => $this->payload['numero_conta'],
            'valor'      => $this->payload['valor'] * -1
        ];
        
        $this->json('post', 'api/conta', $dadosConta)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonStructure(
                [
                    'message',
                    'errors' => [
                        'valor'
                    ]
                ]
            );
    }

    public function test_conta_informacao(): void
    {
        $conta = Conta::factory()->create();
        
        $this->json('get', 'api/conta?id='.$conta->id)
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    'conta_id',
                    'saldo'
                ]
            );
    }

    public function test_conta_informacao2(): void
    {
        $conta = Conta::factory()->create();
        $this->json('get', "api/conta/$conta->id")
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    'conta_id',
                    'saldo'
                ]
            );
    }

    //public function test_aumento_recebimento_pix(): void
    //{
    //    $pixValor = [
    //        'valor' => 10
    //    ];
    //    $conta = Conta::factory()->create();
//
    //    $this->json('patch', 'api/conta/'.$conta->numero_conta, $pixValor)
    //        ->assertStatus(Response::HTTP_OK)
    //        ->assertJsonStructure(
    //            [
    //                'message',
    //                'errors' => [
    //                    'valor'
    //                ]
    //            ]
    //        );
    //}
}
