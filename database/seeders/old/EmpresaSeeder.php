<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;



class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('empresas')->insert(
            [
                [
                    'id'=>1,
                    'nome'=>'Empresa1',
                    'cnpj'=>'123456789',
                    'descricao'=>'descricao Empresa1'
                ]
            ]);
        //
    }
}
