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
    public function store(){
        return $this->hasMany(ListProduct::class, 'store_id', 'id');
    }


}
