<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $this->call(Receptioner::class);
        // $this->call(TypeSeeder::class);
        // $this->call(Receptioner::class);
        // $this->call(StaffSeeder::class);
        $this->call(AdminSeeder::class);
        // $this->call(RequestSeeder::class);
    }
}
