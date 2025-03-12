<?php

namespace App\Http\Repositories;

use App\Models\ScheduleDetail ;

class ScheduleDetailRepository extends BaseRepository{
    protected $model;
    public function __construct(ScheduleDetail $model){
        $this->model = $model;
    }
}
