<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('event_group')->insert([[
            'group_id' => 2,
            'event_id' => 1,
        ],
        [
            'group_id' => 3,
            'event_id' => 1,
        ],
        [
            'group_id' => 2,
            'event_id' => 2,
        ],
        [
            'group_id' => 2,
            'event_id' => 3,
        ],
        [
            'group_id' => 2,
            'event_id' => 4,
        ],
        [
            'group_id' => 3,
            'event_id' => 5,
        ],
        ]);
    }
}
