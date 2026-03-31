<?php

use Illuminate\Support\Facades\Route;

Route::get('/hello', function () {
    return 'Olá, Marcel! Laravel está rodando no Docker 🎉';
});
