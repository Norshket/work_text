<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\ListItems\FakeListItemSeeder;
use Database\Seeders\Users\AdminSeeder;
use Database\Seeders\Users\FakeUserSeeder;
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
            PermissionTableSeeder::class,
            AdminSeeder::class,
        ]);

        if (env('APP_DEBUG')) {
            $this->call([
                FakeUserSeeder::class,
                FakeListItemSeeder::class
            ]);
        }
    }
}
