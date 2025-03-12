<?php

namespace App\Http\Controllers;

use App\Models\Rate;
use App\Models\Store;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function stores()
    {
        $data = Store::all();
        return response()->json($data);
    }

    public function getCommets($store_id) {
        $reviews = Rate::with('customer')->where('store_id', $store_id)->latest()->get();
        return response()->json($reviews);
    }
}
