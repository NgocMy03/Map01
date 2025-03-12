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
    public function staff(){
        return $this->hasMany(Staff::class, 'store_id', 'id');
    }
}
