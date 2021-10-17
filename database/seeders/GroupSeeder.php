<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('groups')->insert([
            [
                'name' => "Unassigned",
            ],
            [
                'name' => "OSD",
            ],
            [
                'name' => 'VSKM',
            ]
        ]);
    }
}
