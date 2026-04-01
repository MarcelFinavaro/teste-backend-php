<?php

use App\Http\Controllers\SincronizacaoController;
use Illuminate\Support\Facades\Route;

// Rota de teste simples
Route::get('/hello', function () {
    return response()->json(['message' => 'API funcionando!']);
});

// Rotas de sincronização
Route::post('/sincronizar/produtos', [SincronizacaoController::class, 'sincronizarProdutos']);
Route::post('/sincronizar/precos', [SincronizacaoController::class, 'sincronizarPrecos']);

// Rota de listagem de produtos e preços
Route::get('/produtos-precos', [SincronizacaoController::class, 'listarProdutosPrecos']);
