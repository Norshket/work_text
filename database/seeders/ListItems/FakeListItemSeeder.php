<?php

namespace Database\Seeders\ListItems;

use App\Models\ListItems\ListItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FakeListItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ListItem::factory(10)->create();
    }
}
