<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileUploadService
{
    /**
     * Upload a file to storage
     *
     * @param UploadedFile $file
     * @param string $folder
     * @param string $disk
     * @return string
     */
    public function uploadFile(UploadedFile $file, string $folder = 'uploads', string $disk = 'public'): string
    {
        $filename = $this->generateFilename($file);

        $path = $file->storeAs($folder, $filename, $disk);

        return $path;
    }

    /**
     * Generate a unique filename for the uploaded file
     *
     * @param UploadedFile $file
     * @return string
     */
    protected function generateFilename(UploadedFile $file): string
    {
        $extension = $file->getClientOriginalExtension();
        $timestamp = now()->timestamp;
        $random = Str::random(8);

        return "{$timestamp}_{$random}.{$extension}";
    }

    /**
     * Delete a file from storage
     *
     * @param string|null $path
     * @param string $disk
     * @return bool
     */
    public function deleteFile(?string $path, string $disk = 'public'): bool
    {
        if (!$path) {
            return false;
        }

        if (Storage::disk($disk)->exists($path)) {
            return Storage::disk($disk)->delete($path);
        }

        return false;
    }
}

