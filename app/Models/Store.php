<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use League\CommonMark\Extension\CommonMark\Node\Block\ListBlock;

class Store extends Model
{
    use HasFactory;
    protected $fillalbe = [
        'ten',
        'diachi',
        'SDT',
        'toadoGPS',
        'hinh'
    ];
    public function listproduct(){
        return $this->hasMany(ListProduct::class);
    }
<<<<<<< HEAD
    public function staff(){
        return $this->hasMany(Staff::class, 'store_id', 'id');
    }
=======

    public function rates(){
        return $this->hasMany(Rate::class, 'store_id', 'id');
    }


>>>>>>> e086e18dc674a8c999a166eb149b33ad61c12985
}
