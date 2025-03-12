<?php

namespace App\Http\Repositories;

use App\Models\Schedule ;

class ScheduleRepository extends BaseRepository{
    protected $model;
    public function __construct(Schedule $model){
        $this->model = $model;
    }
}
