<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Staff extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'ten',
        'gioitinh',
        'namsinh',
        'chucvu',
        'store_id',
        'thoigianlamviec',
    ];
    public function store(){
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }
    public function detail(){
        return $this->hasMany(ScheduleDetail::class, 'staff_id', 'id');
    }
}
