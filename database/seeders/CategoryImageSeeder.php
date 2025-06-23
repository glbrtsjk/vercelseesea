<?php


namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CategoryImageSeeder extends Seeder
{
    public function run(): void
    {
        $targetDir = storage_path('app/public/categories');
        if (!File::exists($targetDir)) {
            File::makeDirectory($targetDir, 0755, true);
        }

        $categoryImages = [
            'pencegahan-polusi-laut' => [
                'gambar_kategori' => 'pencegahan-polusi-laut.jpg',
            ]
        ];

        $categories = Category::all();
        $updatedCount = 0;

        foreach ($categories as $category) {
            if (array_key_exists($category->slug, $categoryImages)) {
                $imageInfo = $categoryImages[$category->slug];

                try {
                    // Delete old image if exists
                    if ($category->gambar_kategori) {
                        if (Storage::disk('public')->exists($category->gambar_kategori)) {
                            Storage::disk('public')->delete($category->gambar_kategori);
                            $this->command->line("Gambar lama dihapus untuk kategori: {$category->nama_kategori}");
                        }
                    }

                    // Set the destination path in the storage
                    $destPath = 'categories/' . $imageInfo['gambar_kategori'];
                    
                    // Check if file exists - use both disk->exists and physical file check
                    $fileExists = Storage::disk('public')->exists($destPath) || 
                                 File::exists(public_path('storage/' . $destPath)) ||
                                 File::exists(storage_path('app/public/' . $destPath));
                    
                    if (!$fileExists) {
                        // Let's try a direct approach - copy from the storage directory we see in the file explorer
                        $sourcePath = public_path('storage/categories/' . $imageInfo['gambar_kategori']);
                        $storageDestPath = storage_path('app/public/categories/' . $imageInfo['gambar_kategori']);
                        
                        if (File::exists($sourcePath)) {
                            // Copy the file to ensure it exists in the expected location
                            File::copy($sourcePath, $storageDestPath);
                            $this->command->info("Gambar di-copy ke lokasi yang diharapkan untuk {$category->nama_kategori}");
                        } else {
                            throw new \Exception("Gambar tidak ditemukan di storage: categories/" . $imageInfo['gambar_kategori']);
                        }
                    }
                    
                    // Update the category record to point to the existing file
                    $category->gambar_kategori = $destPath;
                    $category->save();

                    $updatedCount++;
                    $this->command->info("Gambar berhasil dihubungkan untuk kategori: {$category->nama_kategori}");
                } catch (\Exception $e) {
                    $this->command->error("Gagal memperbarui gambar untuk {$category->nama_kategori}: " . $e->getMessage());
                }
            } else {
                $this->command->warn("Tidak ada gambar untuk kategori: {$category->nama_kategori}");
            }
        }

        $this->command->info("Gambar berhasil diperbarui untuk {$updatedCount} kategori.");
    }
}