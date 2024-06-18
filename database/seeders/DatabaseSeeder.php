<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('pt_BR');
        
        for ($i = 1; $i <= 10; $i++) {
            DB::table('funcionarios')->insert([
                'id' => $i,
                'nome' => $faker->name,
                'funcao' => $faker->jobTitle,
                'telefone' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'cpf' => $faker->cpf(false)
            ]);
            DB::table('clientes')->insert([
                'id' => $i,
                'nome' => $faker->name,
                'telefone' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'cpf' => $faker->cpf(false)
            ]);
        }

        for ($i = 1; $i <= 10; $i++) {
            DB::table('fornecedores')->insert([
                'id' => $i,
                'nome_fantasia' => $faker->name,
                'cnpj' => $faker->cnpj(false)
            ]);
            
        }

        for ($i = 1; $i <= 10; $i++) {
            DB::table('vendas')->insert([
                'id' => $i,
                'data' => $faker->dateTimeThisYear()->format('Y-m-d H:i:s'),
                'valor' => $faker->randomFloat(2, 10, 1000),
                'funcionario_id' => $faker->numberBetween(1, 10),
                'cliente_id' => $faker->numberBetween(1, 10)
            ]);
        }

        DB::table('produtos')->insert(
            [
                [
                    'id'=>1,
                    'valor'=>20.00,
                    'lote'=>'lote 1',
                    'categoria'=>'cosmeticos',
                    'fornecedor_id'=>1,
                    'quantidade'=>5,
                    'descricao'=>'descricao produto1'
                ],
                [
                    'id'=>2,
                    'valor'=>13.00,
                    'lote'=>'lote 1',
                    'categoria'=>'calçados',
                    'fornecedor_id'=>2,
                    'quantidade'=>5,
                    'descricao'=>'descricao produto2'
                ],
                [
                    'id'=>3,
                    'valor'=>340.00,
                    'lote'=>'lote 2',
                    'categoria'=>'cosmeticos',
                    'fornecedor_id'=>3,
                    'quantidade'=>5,
                    'descricao'=>'descricao produto3'
                ],
                [
                    'id'=>4,
                    'valor'=>250.00,
                    'lote'=>'lote 3',
                    'categoria'=>'livros',
                    'fornecedor_id'=>1,
                    'quantidade'=>5,
                    'descricao'=>'descricao produto3'
                ],
                [
                    'id'=>5,
                    'valor'=>250.00,
                    'lote'=>'lote 1',
                    'categoria'=>'livros',
                    'fornecedor_id'=>2,
                    'quantidade'=>5,
                    'descricao'=>'descricao produto3'
                ]

            ]);
    }
}
