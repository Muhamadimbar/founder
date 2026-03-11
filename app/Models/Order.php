<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number', 'name', 'email', 'phone', 'service',
        'package', 'description', 'deadline', 'budget',
        'file_attachment', 'status', 'admin_notes'
    ];

    public static $statuses = [
        'pending'    => ['label' => 'Menunggu',   'color' => 'warning'],
        'proses'     => ['label' => 'Diproses',   'color' => 'info'],
        'selesai'    => ['label' => 'Selesai',     'color' => 'success'],
        'dibatalkan' => ['label' => 'Dibatalkan',  'color' => 'danger'],
    ];

    public function getStatusLabelAttribute(): string
    {
        return self::$statuses[$this->status]['label'] ?? $this->status;
    }

    public function getStatusColorAttribute(): string
    {
        return self::$statuses[$this->status]['color'] ?? 'secondary';
    }
}
