<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Faker\Provider\pt_BR\Person;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('pt_BR');
        $faker->addProvider(new \Faker\Provider\pt_BR\Person($faker));
        $faker->addProvider(new \Faker\Provider\pt_BR\Company($faker));
        

        // Seed Roles
        DB::table('roles')->insert([
            ['role_name' => 'admin'],
            ['role_name' => 'gerente'],
            ['role_name' => 'vendedor']
        ]);

        // Seed Endereços
        $enderecos = collect();
        for ($i = 0; $i < 30; $i++) {
            $enderecos->push(DB::table('enderecos')->insertGetId([
                'cidade' => $faker->city,
                'numero' => $faker->buildingNumber,
                'uf' => $faker->stateAbbr,
                'cep' => $faker->postcode,
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        // Seed Fornecedores
        $fornecedores = collect();
        for ($i = 0; $i < 10; $i++) {
            $id = DB::table('fornecedores')->insertGetId([
                'nome_fantasia' => $faker->company,
                'CNPJ' => $faker->cnpj,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            DB::table('endereco_fornecedor')->insert([
                'endereco_id' => $enderecos->random(),
                'fornecedor_id' => $id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $fornecedores->push($id);
        }

        // Seed Produtos
        $produtos = collect();
        for ($i = 0; $i < 30; $i++) {
            $produtos->push(DB::table('produtos')->insertGetId([
                'lote' => strtoupper(Str::random(6)),
                'nome' => $faker->randomElement([
                    'Camiseta Dry Fit',
                    'Monitor Full HD',
                    'Notebook Gamer',
                    'Caneca Personalizada',
                    'Caixa de Som Bluetooth',
                    'Tênis de Corrida',
                    'Meia Nike',
                    'Calça Jeans'
                ]),
                'valor' => $faker->randomFloat(2, 10, 500),
                'descricao' => $faker->sentence(3),
                'categoria' => $faker->word,
                'quantidade' => $faker->numberBetween(10, 100),
                'fornecedor_id' => $fornecedores->random(),
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        // Seed Clientes
        $clientes = collect();
        for ($i = 0; $i < 15; $i++) {
            $id = DB::table('clientes')->insertGetId([
                'nome' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'cpf' => $faker->cpf,
                'telefone' => $faker->phoneNumber,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            DB::table('endereco_cliente')->insert([
                'endereco_id' => $enderecos->random(),
                'cliente_id' => $id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $clientes->push($id);
        }

        // Seed Funcionários
        $funcionarios = collect();
        for ($i = 0; $i < 10; $i++) {
            $id = DB::table('funcionarios')->insertGetId([
                'nome' => $faker->name,
                'funcao' => $faker->randomElement([
                    'Analista de Dados',
                    'Desenvolvedor',
                    'Vendedor',
                    'Gerente de Loja',
                    'Contador',
                    'Assistente',
                    'Estagiário'
                ]),
                'telefone' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'cpf' => $faker->cpf,
                'user_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            DB::table('endereco_funcionario')->insert([
                'endereco_id' => $enderecos->random(),
                'funcionario_id' => $id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $funcionarios->push($id);
        }

        // Seed Vendas
        $vendas = collect();
        for ($i = 0; $i < 20; $i++) {
            $valorVenda = 0;
            $idVenda = DB::table('vendas')->insertGetId([
                'data' => $faker->dateTimeThisYear()->format('Y-m-d'),
                'valor' => 0, // será atualizado após adicionar produtos
                'funcionario_id' => $funcionarios->random(),
                'cliente_id' => $clientes->random(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $numProdutos = rand(1, 5);
            for ($j = 0; $j < $numProdutos; $j++) {
                $produtoId = $produtos->random();
                $quantidade = rand(1, 3);
                $produtoValor = DB::table('produtos')->where('id', $produtoId)->value('valor');
                $totalProduto = $produtoValor * $quantidade;

                $valorVenda += $totalProduto;

                DB::table('venda_produto')->insert([
                    'data' => now(),
                    'valor' => $totalProduto,
                    'quantidade' => $quantidade,
                    'produto_id' => $produtoId,
                    'venda_id' => $idVenda,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            DB::table('vendas')->where('id', $idVenda)->update(['valor' => $valorVenda]);
        }
    }
}
