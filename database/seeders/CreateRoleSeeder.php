<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CreateRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('roles')->insert([
            ['name' => 'admin','display_name' => 'Administrator'],
            ['name' => 'editor','display_name' => 'Editor'],
            ['name' => 'author','display_name' => 'Author'],
            ['name' => 'normal','display_name' => 'normal'],
        ]);

    }
}
