<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function MapRealLife()
    {
        $stores = Store::all(); //Select * from store
        return view('map_real_life', compact('stores'));
    }

    public function MapAnimation()
    {
        $stores = Store::all();
        return view('map_animation', compact('stores'));
    }
}
