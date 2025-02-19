<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'ten',
        'loai',
        'gia',
        'soluongton',
        'hinhanh',
        'discount_id',
        'deleted_at',
    ];
}
