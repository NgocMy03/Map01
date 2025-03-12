<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    public function MapRealLife()
    {
        $stores = Store::all(); //Select * from store
        return view('map_real_life', compact('stores'));
    }

    public function MapAnimation()
    {
        // $stores = Store::all();
        $stores = DB::table('stores')
        ->leftJoin('list_products', 'stores.id', '=', 'list_products.store_id') // Lấy tất cả stores, kể cả khi không có sản phẩm
        ->leftJoin('products', 'list_products.product_id', '=', 'products.id') // Lấy sản phẩm nếu có
        ->select('stores.*', 'products.ten as product_name', 'products.hinhanh as product_image', 'products.id as product_id',  'list_products.gia as product_price') // Chọn các cột cần thiết
        ->get();
        return view('map_animation', compact('stores'));
    }
}
