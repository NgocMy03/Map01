<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'soluong',
        'gia',
        'store_id',
        'product_id',
    ];
    public function store(){
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }
    public function product(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
