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
        // $stores = DB::table('stores')
        // ->leftJoin('list_products', 'stores.id', '=', 'list_products.store_id') // Lấy tất cả stores, kể cả khi không có sản phẩm
        // ->leftJoin('products', 'list_products.product_id', '=', 'products.id') // Lấy sản phẩm nếu có
        // ->select('stores.*', 'products.ten as product_name', 'products.hinhanh as product_image', 'products.id as product_id',  'list_products.gia as product_price') // Chọn các cột cần thiết
        // ->get();
        $stores = DB::table('stores')
            ->leftJoin('list_products', 'stores.id', '=', 'list_products.store_id')
            ->leftJoin('products', 'list_products.product_id', '=', 'products.id')
            ->select(
                'stores.id',
                'stores.ten AS store_name',
                'stores.toadoGPS',
                'stores.diachi',
                'stores.SDT',
                'stores.hinh',

                DB::raw('GROUP_CONCAT(products.id ORDER BY products.id ASC) AS product_ids'),
                DB::raw('GROUP_CONCAT(products.ten ORDER BY products.id ASC) AS product_names'),
                DB::raw('GROUP_CONCAT(products.hinhanh ORDER BY products.id ASC) AS product_images'),
                DB::raw('GROUP_CONCAT(list_products.gia ORDER BY products.id ASC) AS product_prices')
            )
            ->groupBy('stores.id', 'store_name', 'stores.toadoGPS', 'stores.diachi', 'stores.SDT', 'stores.hinh')
            ->get();
        return view('map_animation', compact('stores'));
    }
}
