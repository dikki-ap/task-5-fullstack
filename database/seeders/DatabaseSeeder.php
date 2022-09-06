<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Material;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        Admin::create([
            "name" => "Administrator",
            "username" => "admin",
            "email" => "admin@gmail.com",
            "password" => Hash::make('admin123')
        ]);

        Teacher::create([
            "name" => "Administrator",
            "username" => "admin",
            "email" => "admin@gmail.com",
            "password" => Hash::make('admin123'),
            "gender" => "Male"
        ]);

        Teacher::create([
            "name" => "Dikki AP",
            "username" => "dikki.ap",
            "email" => "dikki@gmail.com",
            "password" => Hash::make('123'),
            "gender" => "Male"
        ]);

    }
}
