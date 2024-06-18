<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;



class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                [
                    'id'=>1,
                    'name'=>'admin',
                    'email'=>'a@a.com',
                    'empresa_id'=>1,
                    'active'=>'true',
                    'token'=>'O32KmrVT67SMPgZMyiO0m9RV6Y9CAomhOgZUpNEwqAsnDBhc86hXI5v5jjaJ',
                    'password'=>'$2y$10$h2Pe17TRYOyz358sJOyDJezJteFY1n5wutpk2qB6.m5T6tWy9wNSu',
                    'remember_token'=>'null'

                ],
                [
                    'id'=>2,
                    'name'=>'prestador',
                    'email'=>'a@b.com',
                    'empresa_id'=>1,
                    'active'=>'true',
                    'token'=>'O32KmrVT67SMPgZMyiO0m9RV6Y9CAomhOgZUpNEwqAsnDBhc86hXI5v5jjaJ',
                    'password'=>'$2y$10$h2Pe17TRYOyz358sJOyDJezJteFY1n5wutpk2qB6.m5T6tWy9wNSu',
                    'remember_token'=>'null'

                ],
                [
                    'id'=>3,
                    'name'=>'cliente',
                    'email'=>'a@c.com',
                    'empresa_id'=>1,
                    'active'=>'true',
                    'token'=>'O32KmrVT67SMPgZMyiO0m9RV6Y9CAomhOgZUpNEwqAsnDBhc86hXI5v5jjaJ',
                    'password'=>'$2y$10$h2Pe17TRYOyz358sJOyDJezJteFY1n5wutpk2qB6.m5T6tWy9wNSu',
                    'remember_token'=>'null'
                ]
            ]);
        //
    }
}
