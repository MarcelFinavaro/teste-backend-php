<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            ProdutosBaseSeeder::class,
            PrecosBaseSeeder::class,
        ]);

        $this->command->info('✅ Dados de produtos e preços inseridos com sucesso!');
    }
}
