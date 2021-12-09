<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([[
            'name' => "Super Admin",
            'email' => "super.admin@ehb.be",
            'password' => Hash::make("123456"),
            'role' => "super_admin",
            'group_id' => 1,
        ],[
            'name' => "Admin",
            'email' => "admin@ehb.be",
            'password' => Hash::make("123456"),
            'role' => "admin",
            'group_id' => 2,
        ],
        [
            'name' => "Editor",
            'email' => "editor@ehb.be",
            'password' => Hash::make("123456"),
            'role' => "editor",
            'group_id' => 3,
        ],
        [
            'name' => "Viewer",
            'email' => "viewer@ehb.be",
            'password' => Hash::make("123456"),
            'role' => "viewer",
            'group_id' => 2,
        ],
        ]);
    }
}
