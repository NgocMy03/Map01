<?php

namespace App\Http\Repositories;

use App\Models\Staff ;

class StaffRepository extends BaseRepository{
    protected $model;
    public function __construct(Staff $model){
        $this->model = $model;
    }
}
