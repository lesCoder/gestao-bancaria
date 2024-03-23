<?php

namespace App\Services;

use App\Exceptions\SaldoInsuficienteException;
use App\Models\Conta;
use Illuminate\Http\Response;

class TransacaoService
{
    //Operações e sua respectiva taxa
    const OPERACOES = [
        'P' => ['Pix', 0],
        'C' => ['Cartão de Crédito', 5],
        'D' => ['Cartão de Débito', 3],
    ];

    private $conta;

    public function executarTransacao($dados)
    {
        $this->conta = Conta::findorFail($dados['conta_id']);

        $operacaoFormaTaxa = self::OPERACOES[$dados['forma_pagamento']];

        try {
            $this->reduzValor($dados['valor'], $operacaoFormaTaxa[1]);
        } catch (SaldoInsuficienteException $e) {
            return [
                'status' => false,
                'message' => $e->getMessage(),
                'conta' => $this->conta,
                'statusCode' => Response::HTTP_NOT_FOUND,
            ];
        }

        return [
            'status' => true,
            'message' => 'Transação realizada com sucesso.',
            'conta' => $this->conta,
            'statusCode' => 200,
        ];
    }

    public function reduzValor($valor, $taxa)
    {
        $valorTotalOperacao = $valor + ($valor * $taxa / 100);
        if ($this->conta->saldo < $valorTotalOperacao) {
            throw new SaldoInsuficienteException();
        }

        $this->conta->saldo -= $valorTotalOperacao;
        $this->conta->save();
    }
}
