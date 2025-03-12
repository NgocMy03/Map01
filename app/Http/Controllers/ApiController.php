<?php

namespace App\Http\Controllers;

use App\Models\Rate;
use App\Models\Store;
use Illuminate\Http\Request;
use App\Models\ListProduct;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function stores()
    {
        $data = Store::all();
        return response()->json($data);
    }



    public function compareProductPrice($id, $storeId)
    {

        $currentStore = ListProduct::select(
            'products.ten',
            'list_products.gia',
            'products.hinhanh',
            'products.id as product_id',
            'stores.id as store_id',
            'stores.ten as store_name',
            'stores.diachi',
            DB::raw('0 as priority')
        )
            ->join('products', 'list_products.product_id', '=', 'products.id')
            ->join('stores', 'stores.id', '=', 'list_products.store_id')
            ->where('list_products.product_id', $id)
            ->where('list_products.store_id', $storeId);

        $otherStores = ListProduct::select(
            'products.ten',
            'list_products.gia',
            'products.hinhanh',
            'products.id as product_id',
            'stores.id as store_id',
            'stores.ten as store_name',
            'stores.diachi',
            DB::raw('1 as priority')
        )
            ->join('products', 'list_products.product_id', '=', 'products.id')
            ->join('stores', 'stores.id', '=', 'list_products.store_id')
            ->where('list_products.product_id', $id)
            ->where('list_products.store_id', '<>', $storeId);

        $products = $currentStore
            ->unionAll($otherStores)
            ->orderBy('priority', 'ASC')
            ->orderBy('gia', 'ASC')
            ->limit(5)
            ->get();

        return response()->json($products);
    }

    public function getCommets($store_id) {
        $reviews = Rate::with('customer')->where('store_id', $store_id)->latest()->get();
        return response()->json($reviews);
    }
}
