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
        Schema::create('produtos_base', function (Blueprint $table) {
            $table->id();
            $table->string('prod_cod');
            $table->string('prod_nome');
            $table->string('prod_desc')->nullable();
            $table->string('prod_cat');
            $table->string('prod_subcat')->nullable();
            $table->string('prod_mod')->nullable();
            $table->string('prod_cor')->nullable();
            $table->string('prod_fab')->nullable();
            $table->string('prod_peso')->nullable();
            $table->string('prod_larg')->nullable();
            $table->string('prod_prof')->nullable();
            $table->string('prod_alt')->nullable();
            $table->string('prod_und')->nullable();
            $table->date('prod_dt_cad')->nullable();
            $table->boolean('prod_atv')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos_base');
    }
};
