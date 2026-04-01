<?php

use Illuminate\Support\Facades\Route;

// Aqui você pode manter rotas web normais, se precisar.
// Por enquanto, vamos deixar apenas a rota padrão de boas-vindas.

Route::get('/', function () {
    return view('welcome');
});
