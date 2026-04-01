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
        Schema::create('preco_insercao', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produto_id')
                  ->constrained('produto_insercao')
                  ->onDelete('cascade');
            $table->decimal('valor', 10, 2)->nullable();
            $table->string('moeda', 10)->default('BRL');
            $table->string('descricao', 100)->nullable();
            $table->string('acrescimo', 50)->nullable();
            $table->string('promocao', 50)->nullable();
            $table->date('data_inicio_promo')->nullable();
            $table->date('data_fim_promo')->nullable();
            $table->date('data_atualizacao')->nullable();
            $table->string('origem', 50)->nullable();
            $table->string('tipo_cliente', 30)->nullable();
            $table->string('responsavel_venda', 100)->nullable();
            $table->text('observacao')->nullable();
            $table->string('status', 20)->default('ativo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('preco_insercao');
    }
};
