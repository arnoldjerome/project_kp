<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Cari kategori berdasarkan nama
        $indoor = Category::where('name', 'Indoor')->first();
        $outdoor = Category::where('name', 'Outdoor')->first();

        // Tambahkan produk
        Product::insert([
            [
                'name' => 'Meja Kerja Minimalis',
                'description' => 'Meja kayu jati untuk ruang kerja modern.',
                'price' => 2500000,
                'stock' => 10,
                'category_id' => $indoor->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bangku Taman Jati',
                'description' => 'Bangku kayu jati tahan cuaca untuk taman.',
                'price' => 1800000,
                'stock' => 7,
                'category_id' => $outdoor->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}