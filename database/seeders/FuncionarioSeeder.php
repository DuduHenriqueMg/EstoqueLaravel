<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FuncionarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
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
        }
        for ($i = 1; $i <= 10; $i++) {
            DB::table('fornecedor')->insert([
                'id' => $i,
                'nome_fantasia' => $faker->name,
                'cnpj' => $faker->cnpj(false)
            ]);
        }
        DB::table('cliente')->insert([
            'id' => $i,
            'nome' => $faker->name,
            'telefone' => $faker->phoneNumber,
            'email' => $faker->unique()->safeEmail,
            'cpf' => $faker->cpf(false)
        ]);
        
    }
}
