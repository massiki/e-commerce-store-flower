<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Bunga Ulang Tahun',
                'slug' => 'bunga-ulang-tahun',
            ],
            [
                'name' => 'Bunga Wisuda',
                'slug' => 'bunga-wisuda',
            ],
            [
                'name' => 'Bunga Anniversary',
                'slug' => 'bunga-anniversary',
            ],
            [
                'name' => 'Bunga Duka Cita',
                'slug' => 'bunga-duka-cita',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
