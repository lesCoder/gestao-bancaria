<?php

use App\Http\Controllers\ContaController;
use App\Http\Controllers\TransacaoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


//O Laravel esta sobrescrevendo o parâmetro 'conta' para 'contum', a adição do parâmetro é para mudar esse compto
Route::resource('conta', ContaController::class, ['parameters' => [
    'conta' => 'conta'
]]);

Route::get('conta', [ContaController::class, 'showById']);
Route::post('transacao', [TransacaoController::class, 'index']);