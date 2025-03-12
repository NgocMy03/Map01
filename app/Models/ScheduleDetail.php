<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ScheduleDetail extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'schedule_id',
        'staff_id',
        'ngay',
    ];
    public function staff(){
        return $this->belongsTo(Staff::class, 'staff_id', 'id');
    }
    public function schedule(){
        return $this->belongsTo(Schedule::class, 'schedule_id', 'id');
    }
}


