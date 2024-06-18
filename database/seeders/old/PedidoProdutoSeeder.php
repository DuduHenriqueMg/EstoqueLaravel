<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;



class PedidoProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pedido_produtos')->insert(
            [
                [  'id'=>1,
                    'pedido_id'=>1,
                    'produto_id'=>1  ],
                [  'id'=>2,
                   'pedido_id'=>1,
                   'produto_id'=>2  ],
                [  'id'=>3,
                   'pedido_id'=>1,
                   'produto_id'=>3  ],
                [  'id'=>4,
                   'pedido_id'=>2,
                   'produto_id'=>1  ],
                [  'id'=>5,
                   'pedido_id'=>2,
                   'produto_id'=>2  ],
            ]);
        //
    }
}
