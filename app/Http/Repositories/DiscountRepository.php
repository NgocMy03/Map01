<?php

namespace App\Http\Repositories;

use App\Models\Discount;

class DiscountRepository extends BaseRepository{
    protected $model;
    public function __construct(Discount $model){
        $this->model = $model;
    }
}
