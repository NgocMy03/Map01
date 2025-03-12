<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'hoten',
        'SDT',
        'lichsugiaodich',
        'toadoGPS',
        'chitiet'
    ];

    public function rates()
    {
        return $this->hasMany(Rate::class);
    }
}
