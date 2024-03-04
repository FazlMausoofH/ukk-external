<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);\
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => '12345',
            'role' => 'admin',
        ]);
        User::create([
            'name' => 'Owner',
            'email' => 'owner@gmail.com',
            'password' => '12345',
            'role' => 'owner',
        ]);
        User::create([
            'name' => 'Kasir',
            'email' => 'kasir@gmail.com',
            'password' => '12345',
            'role' => 'kasir',
        ]);
        User::create([
            'name' => 'Meja 01',
            'email' => 'meja01@gmail.com',
            'password' => '12345',
            'role' => 'pelanggan',
        ]);
        User::create([
            'name' => 'Meja 02',
            'email' => 'meja02@gmail.com',
            'password' => '12345',
            'role' => 'pelanggan',
        ]);
        Product::create([
            'name' => 'Bakso',
            'price' => 12000,
        ]);
        Product::create([
            'name' => 'Cuangki',
            'price' => 10000,
        ]);
        Product::create([
            'name' => 'Kulit',
            'price' => 3000,
        ]);
        Product::create([
            'name' => 'Krupuk',
            'price' => 3000,
        ]);
        Product::create([
            'name' => 'Es Teh',
            'price' => 2000,
        ]);
        Product::create([
            'name' => 'Aqua',
            'price' => 5000,
        ]);
        Product::create([
            'name' => 'Pizza',
            'price' => 15000,
        ]);
        
    }
}
