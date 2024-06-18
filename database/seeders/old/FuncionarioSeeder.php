<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;



class FuncionarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('funcionarios')->insert(
            [
                [
                    'id'=>1,
                    'empresa_id'=>1,
                    'nome'=>'funcionario1',
                    'cpf'=>'123'
                ],
                [
                    'id'=>2,
                    'empresa_id'=>1,
                    'nome'=>'funcionario2',
                    'cpf'=>'456'
                ],
                [
                    'id'=>3,
                    'empresa_id'=>1,
                    'nome'=>'funcionario3',
                    'cpf'=>'789'
                ]
            ]);
        //
    }
}
