<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'ten',
        'thoigianbatdau',
        'thoigianketthuc',

    ];
    public function detail(){
        return $this->hasMany(ScheduleDetail::class, 'schedule_id', 'id');
    }
}

