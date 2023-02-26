<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\ListItems\ListItem;
use Database\Seeders\Users\AdminSeeder;
use Database\Seeders\Users\PermissionTableSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            AdminSeeder::class,
            PermissionTableSeeder::class            
        ]);

        ListItem::factory(10)->create();
    }
}
