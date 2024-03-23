<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContaRequest;
use App\Models\Conta;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ContaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contas = Conta::all();
        return response()->json([
            'status' => true,
            'contas' => $contas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContaRequest $request)
    {
        $request->validated();
        
        $dadosConta = [
            'numero_conta' => $request->numero_conta,
            'saldo' => $request->valor
        ];

        $conta = Conta::create($dadosConta);
        
        return response()->json([
            'conta' => $conta
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Conta $conta)
    {
        return response()->json([
            'conta_id' => $conta->id,
            'saldo' => $conta->saldo,
        ], Response::HTTP_OK);
    }

    /**
     * Display by queryString
     */
    public function showById(Request $request)
    {
        $id = $request->query('id');
        $conta = Conta::find($id);
        return response()->json([
            'conta_id' => $conta->id,
            'saldo' => $conta->saldo,
        ], Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Conta $conta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $numero_conta)
    {
        $conta = Conta::where('numero_conta', $numero_conta)->first();
        
        $conta->saldo += $request->valor;
        $conta->save();
        return response()->json([
            'message' => 'Saldo atualizado com sucesso!',
            'saldo_atual' => $conta->saldo
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Conta $conta)
    {
        //
    }
}
