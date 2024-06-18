<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;



class ProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('produtos')->insert(
            [
                [
                    'id'=>1,
                    'categoria_id'=>1,
                    'empresa_id'=>1,
                    'nome'=>'produto1',
                    'descricao'=>'descricao produto1'
                ],
                [
                    'id'=>2,
                    'categoria_id'=>2,
                    'empresa_id'=>1,
                    'nome'=>'produto2',
                    'descricao'=>'descricao produto2'
                ],
                [
                    'id'=>3,
                    'categoria_id'=>3,
                    'empresa_id'=>1,
                    'nome'=>'produto3',
                    'descricao'=>'descricao produto3'
                ],
                [
                    'id'=>4,
                    'categoria_id'=>1,
                    'empresa_id'=>1,
                    'nome'=>'produto3',
                    'descricao'=>'descricao produto3'
                ]

            ]);
        //
    }
}
