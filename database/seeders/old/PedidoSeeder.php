<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;



class PedidoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pedidos')->insert(
            [
                [
                    'id'=>1,
                    'funcionario_id'=>1,
                    'mesa_id'=>1,
                    'empresa_id'=>1,
                    'status'=>'aberto',
                    'data'=>'01-01-01',
                    'descricao'=>'descricao pedido1'
                ],
                [
                    'id'=>2,
                    'funcionario_id'=>1,
                    'mesa_id'=>2,
                    'empresa_id'=>1,
                    'status'=>'fechado',
                    'data'=>'01-02-01',
                    'descricao'=>'descricao pedido2'
                ],
                [
                    'id'=>3,
                    'funcionario_id'=>2,
                    'mesa_id'=>1,
                    'empresa_id'=>1,
                    'status'=>'aberto',
                    'data'=>'01-01-01',
                    'descricao'=>'descricao pedido3'
                ],
                [
                    'id'=>4,
                    'funcionario_id'=>3,
                    'mesa_id'=>1,
                    'empresa_id'=>1,
                    'status'=>'aberto',
                    'data'=>'01-01-01',
                    'descricao'=>'descricao pedido4'
                ],
                [
                    'id'=>5,
                    'funcionario_id'=>1,
                    'mesa_id'=>3,
                    'empresa_id'=>1,
                    'status'=>'aberto',
                    'data'=>'01-01-01',
                    'descricao'=>'descricao pedido5'
                ],
            ]);
        //
    }
}
