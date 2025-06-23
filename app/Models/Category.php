<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $primaryKey = 'category_id';

    protected $fillable = [
        'nama_kategori',
        'slug',
        'deskripsi',
        'gambar_kategori'
    ];

    public function articles()
    {
        return $this->hasMany(Article::class, 'category_id', 'category_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }


     public function getImageUrlAttribute()
    {
        if ($this->gambar_kategori) {
            return asset('storage/' . $this->gambar_kategori);
        }

        return asset('images/default-category.jpg');
    }
}
