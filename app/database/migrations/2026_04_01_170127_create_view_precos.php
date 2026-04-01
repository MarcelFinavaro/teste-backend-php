<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        DB::statement("
            CREATE VIEW view_precos AS
            SELECT 
                preco_id as id,
                TRIM(prc_cod_prod) as codigo_produto,
                CAST(
                    REPLACE(
                        REPLACE(TRIM(prc_valor), '.', ''),
                        ',',
                        '.'
                    ) AS FLOAT
                ) AS preco,
                UPPER(TRIM(prc_moeda)) AS moeda,
                TRIM(prc_desc) AS desconto,
                TRIM(prc_acres) AS acrescimo,
                CASE 
                    WHEN prc_promo IS NOT NULL 
                         AND prc_promo != '' 
                         AND prc_promo != '0'
                         AND prc_promo != 'sem preço'
                    THEN CAST(
                        REPLACE(
                            REPLACE(TRIM(prc_promo), '.', ''),
                            ',',
                            '.'
                        ) AS FLOAT
                    )
                    ELSE NULL 
                END AS preco_promocional,
                prc_dt_ini_promo AS data_inicio_promocao,
                prc_dt_fim_promo AS data_fim_promocao,
                prc_dt_atual AS data_atualizacao,
                TRIM(prc_origem) AS origem,
                UPPER(TRIM(prc_tipo_cli)) AS tipo_cliente,
                TRIM(prc_vend_resp) AS vendedor_responsavel,
                TRIM(prc_obs) AS observacao,
                LOWER(TRIM(prc_status)) AS status,
                datetime('now') AS created_at,
                datetime('now') AS updated_at
            FROM precos_base
            WHERE LOWER(TRIM(prc_status)) = 'ativo'
                AND prc_valor IS NOT NULL 
                AND prc_valor != ''
                AND prc_valor != 'sem preço'
                AND prc_valor != '0'
                AND TRIM(prc_valor) NOT LIKE '%sem%'
        ");
    }

    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS view_precos');
    }
};
