<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
   DB::table('products')->insert([
    [
        'name' => 'Laptop',
        'description' => 'A portable computer',
        'price' => 799.99,
    ],
    [
        'name' => 'Mouse',
        'description' => 'A computer mouse',
        'price' => 29.99,
    ],
    [
        'name' => 'Keyboard',
        'description' => 'A computer keyboard',
        'price' => 49.99,
    ],
    [
        'name' => 'Monitor',
        'description' => 'A computer monitor',
        'price' => 199.99,
    ],
]);
    }
}
