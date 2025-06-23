<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'nama_kategori' => 'Konservasi Laut',
                'slug' => 'konservasi-laut',
                'deskripsi' => 'Topik tentang pelestarian ekosistem laut dan melindungi kehidupan laut',
                'gambar_kategori' => 'storage/categories/konservasi-laut.jpg'
            ],
            [
                'nama_kategori' => 'Perlindungan Terumbu Karang',
                'slug' => 'perlindungan-terumbu-karang',
                'deskripsi' => 'Topik tentang konservasi dan restorasi terumbu karang',
                'gambar_kategori' => 'storage/categories/terumbu-karang.jpg'
            ],
            [
                'nama_kategori' => 'Pencegahan Polusi Laut',
                'slug' => 'pencegahan-polusi-laut',
                'deskripsi' => 'Topik tentang pengurangan polusi laut dan upaya pembersihan',
                'gambar_kategori' => 'storage/categories/pencegahan-polusi-laut.jpg'
            ],
            [
                'nama_kategori' => 'Perikanan Berkelanjutan',
                'slug' => 'perikanan-berkelanjutan',
                'deskripsi' => 'Topik tentang perikanan berkelanjutan dan Informasi tentang praktik penangkapan ikan yang bertanggung jawab dan pengelolaan sumber daya laut',
                'gambar_kategori' => 'storage/categories/perikanan-berkelanjutan.jpg'
            ],
            [
                'nama_kategori' => 'Perlindungan Spesies Laut',
                'slug' => 'perlindungan-spesies-laut',
                'deskripsi' => 'Topik tentang melindungi spesies laut yang terancam punah dan habitatnya',
                'gambar_kategori' => 'storage/categories/spesies-laut.jpg'
            ],
            [
                'nama_kategori' => 'Wisata Bahari Berkelanjutan',
                'slug' => 'wisata-bahari-berkelanjutan',
                'deskripsi' => 'Informasi tentang pariwisata laut yang ramah lingkungan dan berkelanjutan',
                'gambar_kategori' => 'storage/categories/wisata-bahari.jpg'
            ],
              [
                'nama_kategori' => 'Penangulangan Pesisir Pantai',
                'slug' => 'penangulangan-pesisir-pantai',
                'deskripsi' => 'Topik tentang upaya penanggulangan kerusakan pesisir pantai dan perlindungan ekosistem pesisir',
                'gambar_kategori' => 'storage/categories/pesisir-pantai.jpg'
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
