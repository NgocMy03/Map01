<?php

namespace App\Http\Repositories;

use App\Models\Product;

class ProductRepository extends BaseRepository{
    protected $model;
    public function __construct(Product $model){
        $this->model = $model;
    }
}
