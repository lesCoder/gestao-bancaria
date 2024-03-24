<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransacaoRequest;
use App\Services\TransacaoLogService;
use App\Services\TransacaoService;
use Illuminate\Http\Response;

class TransacaoController extends Controller
{
    protected TransacaoService $transacaoService;

    public function __construct(TransacaoService $transacaoService)
    {
        $this->transacaoService = $transacaoService;
    }

    public function index(TransacaoRequest $request)
    {
        $resultado = $this->transacaoService->executarTransacao($request->validated());

        $transacaoLogService = new TransacaoLogService();

        $transacaoLogService->store([
            'conta_id' => $request->conta_id,
            'tipo' => $request->forma_pagamento,
            'valor' => $request->valor,
            'descricao' => '',
        ]);

        if ($resultado['status']) {
            return response()->json([
                'message' => $resultado['message'],
                'conta' => $resultado['conta']
            ], Response::HTTP_CREATED);
        } else {
            return response()->json([
                'message' => $resultado['message']
            ], $resultado['statusCode']);
        }
    }
}
