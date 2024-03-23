<?php

namespace App\Services;

use App\Models\transacao;

class TransacaoLogService
{
    public function store(Array $data)
    {
        transacao::create($data);

        return response()->json(['message' => 'Transação registrada com sucesso'], 201);
    }
}
