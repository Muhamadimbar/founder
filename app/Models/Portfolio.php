<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'category', 'description', 'image', 'client', 'is_featured', 'is_active'];

    protected $casts = ['is_featured' => 'boolean', 'is_active' => 'boolean'];

    public static $categories = [
        'desain-grafis'   => 'Desain Grafis',
        'perbaikan-laptop'=> 'Perbaikan Laptop',
        'bantuan-tugas'   => 'Bantuan Tugas',
        'website-umkm'    => 'Website UMKM',
    ];

    public function getCategoryLabelAttribute(): string
    {
        return self::$categories[$this->category] ?? $this->category;
    }
}
