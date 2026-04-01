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
        Schema::create('precos_base', function (Blueprint $table) {
            $table->id();
            $table->string('prc_cod_prod');
            $table->string('prc_valor')->nullable();
            $table->string('prc_moeda')->nullable();
            $table->string('prc_desc')->nullable();
            $table->string('prc_acres')->nullable();
            $table->string('prc_promo')->nullable();
            $table->date('prc_dt_ini_promo')->nullable();
            $table->date('prc_dt_fim_promo')->nullable();
            $table->date('prc_dt_atual')->nullable();
            $table->string('prc_origem')->nullable();
            $table->string('prc_tipo_cli')->nullable();
            $table->string('prc_vend_resp')->nullable();
            $table->string('prc_obs')->nullable();
            $table->string('prc_status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('precos_base');
    }
};
