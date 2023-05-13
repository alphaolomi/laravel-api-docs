<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    // use WithoutModelEvents;

    public function run(): void
    {
        \App\Models\Product::factory(10)->create();
    }
}
