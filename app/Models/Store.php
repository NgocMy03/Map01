<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
