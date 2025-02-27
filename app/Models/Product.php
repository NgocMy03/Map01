<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'ten',
        'loai',
        'gia',
        'soluongton',
        'hinhanh',
        'discount_id',
        'deleted_at',
    ];
    public function discount(){
        return $this->belongsTo(Discount::class, 'discount_id', 'id');
    }
}
