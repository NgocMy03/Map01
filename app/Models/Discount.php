<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Discount extends Model
{
    use HasFactory, SoftDeletes;
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
