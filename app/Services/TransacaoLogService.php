<?php

namespace App\Services;

use App\Exceptions\SaldoInsuficienteException;
use App\Models\Conta;
use App\Models\transacao;
use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Response;

class TransacaoLogService
{
    public function store(Array $data)
    {
        // Processar a transação...
        //dd($data);
        // Criar uma nova entrada na tabela transacoes
        transacao::create($data);

        // Retornar uma resposta de sucesso
        return response()->json(['message' => 'Transação registrada com sucesso'], 201);
    }
}
