<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'name'  => 'admin',
            'email' => 'admin@gmail.com',
            'password'  => bcrypt('admin123')
        ]);

        // \App\Models\Post::factory(100)->create();
        // \App\Models\Universitas::factory(100)->create();
        // \App\Models\Laporan::factory(100)->create();
        // \App\Models\Publikasi::factory(100)->create();
        // \App\Models\Naskah::factory(100)->create();
    }
}
