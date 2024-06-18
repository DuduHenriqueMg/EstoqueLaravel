<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserRoleSeeder;
use Database\Seeders\ProdutoSeeder;
use Database\Seeders\EmpresaSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(
            [
                UserSeeder::class,
                RoleSeeder::class,
                UserRoleSeeder::class,
                EmpresaSeeder::class,
                CategoriaSeeder::class,
                FuncionarioSeeder::class,
                ProdutoSeeder::class,
                MesaSeeder::class,
                PedidoSeeder::class,
                PedidoProdutoSeeder::class,
           ]);
    }
}
