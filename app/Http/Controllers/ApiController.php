<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function stores()
    {
        $data = Store::all();
        return response()->json($data);
    }
}
