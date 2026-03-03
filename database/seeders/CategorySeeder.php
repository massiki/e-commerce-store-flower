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
                'description' => 'Koleksi bunga cantik untuk merayakan hari ulang tahun orang tersayang.',
                'image' => 'categories/birthday.jpg',
            ],
            [
                'name' => 'Bunga Wisuda',
                'slug' => 'bunga-wisuda',
                'description' => 'Rangkaian bunga elegan untuk merayakan momen wisuda yang berkesan.',
                'image' => 'categories/graduation.jpg',
            ],
            [
                'name' => 'Bunga Anniversary',
                'slug' => 'bunga-anniversary',
                'description' => 'Bunga romantis untuk merayakan hari jadi bersama pasangan tercinta.',
                'image' => 'categories/anniversary.jpg',
            ],
            [
                'name' => 'Bunga Duka Cita',
                'slug' => 'bunga-duka-cita',
                'description' => 'Rangkaian bunga untuk menyampaikan belasungkawa dan simpati.',
                'image' => 'categories/sympathy.jpg',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
