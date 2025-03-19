<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Staff extends Authenticatable
{
    use HasFactory, SoftDeletes, HasApiTokens, Notifiable;
    protected $table = 'staff';
    protected $fillable = [
        'ten',
        'gioitinh',
        'namsinh',
        'chucvu',
        'store_id',
        'thoigianlamviec',
        'email',
        'password',
        'status'
    ];
    public function store(){
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }
    public function detail(){
        return $this->hasMany(ScheduleDetail::class, 'staff_id', 'id');
    }
}
