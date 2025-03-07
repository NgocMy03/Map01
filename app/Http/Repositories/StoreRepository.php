<?php

namespace App\Http\Repositories;

use App\Models\Store ;

class StoreRepository extends BaseRepository{
    protected $model;
    public function __construct(Store $model){
        $this->model = $model;
    }
}
