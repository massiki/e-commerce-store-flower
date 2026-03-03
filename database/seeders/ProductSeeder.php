<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // Bunga Ulang Tahun (category_id: 1)
            [
                'category_id' => 1,
                'name' => 'Bouquet Pink Roses',
                'slug' => 'bouquet-pink-roses',
                'description' => 'Rangkaian mawar pink premium yang cantik dan elegan. Cocok untuk memberikan kesan spesial di hari ulang tahun. Terdiri dari 20 tangkai mawar pink segar pilihan terbaik.',
                'price' => 350000,
                'stock' => 25,
                'image' => 'products/pink-roses.jpg',
                'badge' => 'best_seller',
                'is_featured' => true,
                'rating' => 4.8,
            ],
            [
                'category_id' => 1,
                'name' => 'Garden Bloom Birthday',
                'slug' => 'garden-bloom-birthday',
                'description' => 'Buket bunga campuran garden style dengan warna-warna ceria. Perpaduan lily, daisy, dan carnation yang sempurna untuk momen bahagia.',
                'price' => 275000,
                'stock' => 18,
                'image' => 'products/garden-bloom.jpg',
                'badge' => 'new',
                'is_featured' => true,
                'rating' => 4.5,
            ],
            [
                'category_id' => 1,
                'name' => 'Sunshine Sunflower Bouquet',
                'slug' => 'sunshine-sunflower-bouquet',
                'description' => 'Buket bunga matahari segar yang membawa keceriaan. 10 tangkai sunflower premium dengan packaging eksklusif.',
                'price' => 320000,
                'stock' => 15,
                'image' => 'products/sunflower.jpg',
                'badge' => null,
                'is_featured' => false,
                'rating' => 4.6,
            ],

            // Bunga Wisuda (category_id: 2)
            [
                'category_id' => 2,
                'name' => 'Elegant Graduation Bouquet',
                'slug' => 'elegant-graduation-bouquet',
                'description' => 'Buket wisuda elegan dengan bunga mawar merah dan baby breath. Dilengkapi dengan pita satin dan kartu ucapan. Pilihan terbaik untuk wisudawan/wisudawati.',
                'price' => 450000,
                'stock' => 20,
                'image' => 'products/graduation-elegant.jpg',
                'badge' => 'best_seller',
                'is_featured' => true,
                'rating' => 4.9,
            ],
            [
                'category_id' => 2,
                'name' => 'Pastel Dream Graduation',
                'slug' => 'pastel-dream-graduation',
                'description' => 'Buket wisuda dengan tema pastel yang lembut dan anggun. Terdiri dari roses, carnation, dan eucalyptus.',
                'price' => 380000,
                'stock' => 12,
                'image' => 'products/pastel-graduation.jpg',
                'badge' => 'new',
                'is_featured' => true,
                'rating' => 4.7,
            ],
            [
                'category_id' => 2,
                'name' => 'Classic Red Graduation',
                'slug' => 'classic-red-graduation',
                'description' => 'Buket klasik dengan mawar merah premium. Simbol keberhasilan dan prestasi.',
                'price' => 400000,
                'stock' => 10,
                'image' => 'products/red-graduation.jpg',
                'badge' => null,
                'is_featured' => false,
                'rating' => 4.4,
            ],

            // Bunga Anniversary (category_id: 3)
            [
                'category_id' => 3,
                'name' => 'Romantic Red Roses',
                'slug' => 'romantic-red-roses',
                'description' => 'Rangkaian 50 tangkai mawar merah premium dalam box eksklusif. Ekspresi cinta yang sempurna untuk hari jadi.',
                'price' => 750000,
                'stock' => 8,
                'image' => 'products/romantic-roses.jpg',
                'badge' => 'best_seller',
                'is_featured' => true,
                'rating' => 5.0,
            ],
            [
                'category_id' => 3,
                'name' => 'Love in Bloom Box',
                'slug' => 'love-in-bloom-box',
                'description' => 'Flower box premium berisi mawar merah dan putih dengan cokelat premium. Gift set romantis untuk anniversary.',
                'price' => 550000,
                'stock' => 14,
                'image' => 'products/love-bloom.jpg',
                'badge' => null,
                'is_featured' => false,
                'rating' => 4.6,
            ],
            [
                'category_id' => 3,
                'name' => 'Forever Love Bouquet',
                'slug' => 'forever-love-bouquet',
                'description' => 'Buket campuran bunga premium: rose, tulip, dan lily dalam balutan wrapping mewah.',
                'price' => 480000,
                'stock' => 16,
                'image' => 'products/forever-love.jpg',
                'badge' => 'new',
                'is_featured' => true,
                'rating' => 4.8,
            ],

            // Bunga Duka Cita (category_id: 4)
            [
                'category_id' => 4,
                'name' => 'White Lily Sympathy',
                'slug' => 'white-lily-sympathy',
                'description' => 'Rangkaian bunga lily putih yang elegan untuk menyampaikan belasungkawa. Dikemas dengan penuh kehormatan.',
                'price' => 500000,
                'stock' => 10,
                'image' => 'products/white-lily.jpg',
                'badge' => null,
                'is_featured' => false,
                'rating' => 4.7,
            ],
            [
                'category_id' => 4,
                'name' => 'Peace Standing Flower',
                'slug' => 'peace-standing-flower',
                'description' => 'Standing flower duka cita dengan bunga krisan putih dan anggrek. Ukuran besar & megah.',
                'price' => 850000,
                'stock' => 6,
                'image' => 'products/standing-flower.jpg',
                'badge' => null,
                'is_featured' => false,
                'rating' => 4.5,
            ],
            [
                'category_id' => 4,
                'name' => 'Serene Memorial Wreath',
                'slug' => 'serene-memorial-wreath',
                'description' => 'Karangan bunga duka cita berbentuk lingkaran (wreath) dengan bunga-bunga putih dan hijau.',
                'price' => 650000,
                'stock' => 8,
                'image' => 'products/memorial-wreath.jpg',
                'badge' => null,
                'is_featured' => false,
                'rating' => 4.3,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
