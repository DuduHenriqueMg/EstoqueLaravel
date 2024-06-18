<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('produtos')->insert(
            [
                [
                    'id'=>1,
                    'valor'=>20.00,
                    'lote'=>'lote 1',
                    'categoria'=>'cosmeticos',
                    'fornecedor_id'=>1,
                    'quantidade'=>5,
                    'nome'=>'produto1',
                    'descricao'=>'descricao produto1'
                ],
                [
                    'id'=>2,
                    'valor'=>13.00,
                    'lote'=>'lote 1',
                    'categoria'=>'calçados',
                    'fornecedor_id'=>2,
                    'quantidade'=>5,
                    'nome'=>'produto2',
                    'descricao'=>'descricao produto2'
                ],
                [
                    'id'=>3,
                    'valor'=>340.00,
                    'lote'=>'lote 2',
                    'categoria'=>'cosmeticos',
                    'fornecedor_id'=>3,
                    'quantidade'=>5,
                    'nome'=>'produto3',
                    'descricao'=>'descricao produto3'
                ],
                [
                    'id'=>4,
                    'valor'=>250.00,
                    'lote'=>'lote 3',
                    'categoria'=>'livros',
                    'fornecedor_id'=>1,
                    'quantidade'=>5,
                    'nome'=>'produto3',
                    'descricao'=>'descricao produto3'
                ],
                [
                    'id'=>5,
                    'valor'=>250.00,
                    'lote'=>'lote 1',
                    'categoria'=>'livros',
                    'fornecedor_id'=>2,
                    'quantidade'=>5,
                    'nome'=>'produto3',
                    'descricao'=>'descricao produto3'
                ]

            ]);
    }
}
