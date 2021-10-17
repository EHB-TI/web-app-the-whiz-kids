<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('events')->insert([[
            'created_by_id' => 1,
            'updated_by_id' => 1,
            'name' => 'VSKM Beste kring',
            'title_color' => 'rgb(255, 255, 255)',
            'display_title' => "block",
            'desc_long' => 'VSKM doet een event om te vieren dat ze de beste kring zijn',
            'desc_short' => 'VSKM is de beste kring yey',
            'url_event' => 'https://facebook.com',
            'event_date_start' => new DateTime('2021-01-31T15:03:01'),
            'event_date_end' => new DateTime('2021-01-31T15:03:01'),
            'visibility' => true,
        ],
        [
            'created_by_id' => 1,
            'updated_by_id' => 1,
            'name' => 'exotische zanden by midnight',
            'title_color' => 'rgb(255, 255, 255)',
            'display_title' => "none",
            'desc_long' => 'ja 16 exotische zanden dronken/high gaan bekijken om middernacht',
            'desc_short' => '16 exotische zanden bekijken',
            'url_event' => 'https://facebook.com/lmao',
            'event_date_start' => new DateTime('2020-12-01T14:03:01'),
            'event_date_end' => new DateTime('2020-12-01T14:03:01'),
            'visibility' => true,
        ],
        [
            'created_by_id' => 1,
            'updated_by_id' => 1,
            'name' => 'St Ve',
            'title_color' => 'rgb(255, 255, 255)',
            'display_title' => "block",
            'desc_long' => 'Een hele droevige St Ve :(',
            'desc_short' => 'Sint Verheage',
            'url_event' => 'https://facebook.com/stve',
            'event_date_start' => new DateTime('2020-10-30T8:03:01'),
            'event_date_end' => new DateTime('2020-11-5T8:03:01'),
            'visibility' => true,
        ],
        [
            'created_by_id' => 1,
            'updated_by_id' => 1,
            'name' => 'Over Dopen En Geheim',
            'title_color' => 'rgb(255, 255, 255)',
            'display_title' => "none",
            'desc_long' => 'Iets met VUB en dopen ofzo ja geen idee',
            'desc_short' => 'Niet gedoopten niet welkom',
            'url_event' => 'https://facebook.com/lmao',
            'event_date_start' => new DateTime('2021-03-01T15:03:01'),
            'event_date_end' => new DateTime('2021-03-01T15:03:01'),
            'visibility' => false,
        ],
        [
            'created_by_id' => 1,
            'updated_by_id' => 1,
            'name' => 'Doritos Championship',
            'title_color' => 'rgb(255, 255, 255)',
            'display_title' => "block",
            'desc_long' => 'Dit is een doritos championship in ere van doritos',
            'desc_short' => 'among us tournament competetive',
            'url_event' => 'https://facebook.com/lmao',
            'event_date_start' => new DateTime('2021-01-24T15:03:01'),
            'event_date_end' => new DateTime('2021-01-26T15:03:01'),
            'visibility' => true,
        ],
        ]);
    }
}
