<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        DB::statement("
            CREATE VIEW view_produtos AS
            SELECT 
                id,
                UPPER(prod_cat) AS categoria_normalizada,
                UPPER(prod_subcat) AS subcategoria_normalizada,
                TRIM(prod_nome) AS nome,
                TRIM(prod_desc) AS descricao,
                prod_cod,
                prod_mod,
                prod_cor,
                prod_fab,
                prod_peso,
                prod_larg,
                prod_prof,
                prod_alt,
                prod_und,
                prod_dt_cad
            FROM produtos_base
            WHERE prod_atv = 1
        ");
    }

    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS view_produtos");
    }
};
