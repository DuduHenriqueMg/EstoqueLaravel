<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_roles')->insert(
            [
                [
                    'id'=>1,
                    'role_id'=>1,
                    'user_id'=>1,
                    'type'=>'sitema1'
                ],
                [
                    'id'=>2,
                    'role_id'=>2,
                    'user_id'=>2,
                    'type'=>'sitema1'
                ],
                [
                    'id'=>3,
                    'role_id'=>3,
                    'user_id'=>3,
                    'type'=>'sitema1'
                ]
            ]);
        //
    }
}
