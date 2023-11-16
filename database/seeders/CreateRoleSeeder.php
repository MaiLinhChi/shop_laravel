<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            ['name' => 'admin', 'display_name' => 'System manager'],
            ['name' => 'dev', 'display_name' => 'Deverloper'],
            ['name' => 'content', 'display_name' => 'Write content'],
            ['name' => 'guest', 'display_name' => 'Client'],
        ]);
    }
}
