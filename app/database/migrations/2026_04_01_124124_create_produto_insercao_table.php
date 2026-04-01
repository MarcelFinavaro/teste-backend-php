<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produto_insercao', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 30)->unique();
            $table->string('nome', 150);
            $table->string('categoria', 50)->nullable();
            $table->string('subcategoria', 50)->nullable();
            $table->text('descricao')->nullable();
            $table->string('fabricante', 100)->nullable();
            $table->string('modelo', 50)->nullable();
            $table->string('cor', 30)->nullable();
            $table->string('peso', 20)->nullable();
            $table->string('largura', 20)->nullable();
            $table->string('altura', 20)->nullable();
            $table->string('profundidade', 20)->nullable();
            $table->string('unidade', 10)->nullable();
            $table->boolean('ativo')->default(true);
            $table->date('data_cadastro')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produto_insercao');
    }
};
