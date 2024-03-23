<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiContaController;
use App\Http\Controllers\ApiTransacaoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//O Laravel esta sobrescrevendo o parâmetro 'conta' para 'contum', a adição do parâmetro é para mudar esse compto
Route::resource('conta', ApiContaController::class, ['parameters' => [
    'conta' => 'conta'
]]);

Route::get('conta', [ApiContaController::class, 'showById']);
Route::post('transacao', [ApiTransacaoController::class, 'index']);

// Adiciona uma rota PATCH específica para atualizar o saldo, a padrão nao esta funcionando
//Route::patch('contas/{conta}', [ApiContaController::class, 'update'])->name('contas.aumentarSaldo');
