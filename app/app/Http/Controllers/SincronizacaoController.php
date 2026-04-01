<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SincronizacaoController extends Controller
{
    public function sincronizarProdutos(Request $request)
    {
        try {
            $produtos = DB::table('view_produtos')->get();

            foreach ($produtos as $produto) {
                DB::table('produto_insercao')->updateOrInsert(
                    ['codigo' => trim($produto->prod_cod)],
                    [
                        'codigo' => trim($produto->prod_cod),
                        'nome' => $produto->nome,
                        'categoria' => $produto->categoria_normalizada,
                        'subcategoria' => $produto->subcategoria_normalizada,
                        'descricao' => $produto->descricao,
                        'fabricante' => $produto->prod_fab,
                        'modelo' => $produto->prod_mod,
                        'cor' => $produto->prod_cor,
                        'peso' => $produto->prod_peso,
                        'largura' => $produto->prod_larg,
                        'altura' => $produto->prod_alt,
                        'profundidade' => $produto->prod_prof,
                        'unidade' => $produto->prod_und,
                        'ativo' => 1,
                        'data_cadastro' => $produto->prod_dt_cad,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );
            }

            return response()->json([
                'success' => true,
                'message' => 'Produtos sincronizados com sucesso',
                'total_processados' => count($produtos),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao sincronizar produtos',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function sincronizarPrecos(Request $request)
    {
        try {
            $precos = DB::table('view_precos')->get();
            $processados = 0;

            foreach ($precos as $preco) {
                $produto = DB::table('produto_insercao')
                    ->where('codigo', trim($preco->codigo_produto))
                    ->first();

                if ($produto) {
                    DB::table('preco_insercao')->updateOrInsert(
                        ['produto_id' => $produto->id],
                        [
                            'produto_id' => $produto->id,
                            'valor' => $preco->preco,
                            'moeda' => $preco->moeda,
                            'descricao' => $preco->desconto,
                            'acrescimo' => $preco->acrescimo,
                            'promocao' => $preco->preco_promocional,
                            'data_inicio_promo' => $preco->data_inicio_promocao,
                            'data_fim_promo' => $preco->data_fim_promocao,
                            'data_atualizacao' => $preco->data_atualizacao,
                            'origem' => $preco->origem,
                            'tipo_cliente' => $preco->tipo_cliente,
                            'responsavel_venda' => $preco->vendedor_responsavel,
                            'observacao' => $preco->observacao,
                            'status' => $preco->status,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]
                    );
                    ++$processados;
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Preços sincronizados com sucesso',
                'total_processados' => $processados,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao sincronizar preços',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function listarProdutosPrecos(Request $request)
    {
        try {
            $perPage = $request->get('per_page', 15);
            $page = $request->get('page', 1);

            $query = DB::table('produto_insercao as p')
                ->leftJoin('preco_insercao as pc', 'p.id', '=', 'pc.produto_id')
                ->select(
                    'p.id',
                    'p.codigo',
                    'p.nome',
                    'p.categoria',
                    'p.subcategoria',
                    'p.descricao',
                    'p.fabricante',
                    'p.modelo',
                    'p.cor',
                    'p.ativo as status',
                    'p.data_cadastro',
                    'pc.valor as preco',
                    'pc.promocao as preco_promocional',
                    'pc.moeda',
                    'pc.status as preco_status'
                )
                ->where('p.ativo', 1);

            $resultados = $query->paginate($perPage, ['*'], 'page', $page);

            return response()->json([
                'success' => true,
                'data' => $resultados->items(),
                'pagination' => [
                    'current_page' => $resultados->currentPage(),
                    'last_page' => $resultados->lastPage(),
                    'per_page' => $resultados->perPage(),
                    'total' => $resultados->total(),
                    'from' => $resultados->firstItem(),
                    'to' => $resultados->lastItem(),
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao listar produtos e preços',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
