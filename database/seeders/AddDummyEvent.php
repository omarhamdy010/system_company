<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class AddDummyEvent extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = [
            ['title'=>'Demo Event-1', 'start_date'=>'2022-04-16', 'end_date'=>'2022-04-17'],
            ['title'=>'Demo Event-2', 'start_date'=>'2022-04-16', 'end_date'=>'2022-04-18'],
            ['title'=>'Demo Event-3', 'start_date'=>'2022-04-18', 'end_date'=>'2022-04-18'],
            ['title'=>'Demo Event-3', 'start_date'=>'2022-04-22', 'end_date'=>'2022-04-22'],
        ];
        foreach ($data as $key => $value) {
            Event::create($value);
        }
    }
}
