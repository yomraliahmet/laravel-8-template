<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         User::factory(5)->create();

         $this->call(PermissionSeeder::class);
         $this->call(AdminSeeder::class);
         $this->call(MenuSeeder::class);
         Artisan::call("cache:clear");
    }
}
