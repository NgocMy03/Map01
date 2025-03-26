<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;
    protected $fillable = [
        'chuongtrinhKM',
        'thoigianapdung',
        'mucgiamgia',
        'deleted_at',
    ];
    public function discount_pro(){
        return $this->hasMany(Product::class, 'product_id', 'id');
    }
}
