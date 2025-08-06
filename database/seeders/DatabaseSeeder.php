<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
{
    \App\Models\User::factory()->create([
        'name' => 'مدير النظام',
        'email' => 'admin@example.com',
        'password' => bcrypt('12345678'),
        'role' => 'admin',
    ]);

    \App\Models\User::factory(5)->create(); // 5 مستخدمين عاديين
}

}
