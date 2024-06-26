<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;



class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert(
            [
                ['id'=>1,'role'=>'admin', 'description'=>'administrador'],
                ['id'=>2,'role'=>'moderator','description'=>'prestador'],
                ['id'=>3,'role'=>'basic','description'=>'cliente']
            ]);
        //
    }
}
