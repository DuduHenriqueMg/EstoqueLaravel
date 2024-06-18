<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;



class MesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mesas')->insert(
            [
                [
                    'id'=>1,
                    'funcionario_id'=>1,
                    'empresa_id'=>1,
                    'numero'=>1
                ],
                [
                    'id'=>2,
                    'funcionario_id'=>2,
                    'empresa_id'=>1,
                    'numero'=>2
                ],
                [
                    'id'=>3,
                    'funcionario_id'=>3,
                    'empresa_id'=>1,
                    'numero'=>3
                ]
            ]);
        //
    }
}
