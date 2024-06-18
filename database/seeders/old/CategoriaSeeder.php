<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;



class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorias')->insert(
            [
                [
                    'id'=>1,
                    'empresa_id'=>1,
                    'nome'=>'Categoria1',
                    'descricao'=>'descricao Categoria1'
                ],
                [
                    'id'=>2,
                    'empresa_id'=>1,
                    'nome'=>'Categoria2',
                    'descricao'=>'descricao Categoria2'
                ],
                [
                    'id'=>3,
                    'empresa_id'=>1,
                    'nome'=>'Categoria3',
                    'descricao'=>'descricao Categoria3'
                ]
            ]);
        //
    }
}
