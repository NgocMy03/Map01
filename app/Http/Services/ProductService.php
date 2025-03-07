<?php

namespace App\Http\Services;

use App\Models\Product;
use App\Http\Repositories\ProductRepository;
use App\Models\ListProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;


class ProductService{
    protected $productRepo;

    public function __construct(ProductRepository $productRepo)
    {
        $this->productRepo = $productRepo;
    }

    public function create(Request $request)
    {
        // dd($request->hinhanh);
        try {
            $fileName = "";

            // Xử lý file ảnh nếu có
            if ($request->hasFile('hinhanh')) {
                $fileName = $request->file('hinhanh')->getClientOriginalName();
                $request->hinhanh->move(public_path('assets/img/product/'), $fileName);
                $data['hinhanh'] = 'assets/img/product/' . $fileName;
            }

            // Tạo sản phẩm mới
            $product = $this->productRepo->create([
                'ten' => $request->ten,
                'loai' => $request->loai,
                'hinhanh' => $fileName,
                'discount_id' => $request->discount_id
            ]);

            // Kiểm tra nếu request có 'soluong', 'gia', 'store_id'
            if ($request->has(['soluong', 'gia', 'store_id'])) {
                // Tạo chi tiết cho list_products
                $details = [
                    'soluong' => $request->soluong,
                    'gia' => $request->gia,
                    'store_id' => $request->store_id,
                    'product_id' => $product->id  // Sử dụng ID của sản phẩm vừa tạo
                ];

                // Chèn bản ghi vào bảng list_products
                ListProduct::create($details);
            }
        } catch (\Exception $e) {
            // Xử lý lỗi nếu có
            dd($e->getMessage());
        }

    }

    public function update(Request $request, $id)
    {
        try {
            $product = Product::find($id);
            $fileName = "";

            // Xử lý file ảnh nếu có
            if ($request->hasFile('hinhanh')) {
                $fileName = $request->file('hinhanh')->getClientOriginalName();
                $request->hinhanh->move(public_path('assets/img/product/'), $fileName);
                $data['hinhanh'] = 'assets/img/product/' . $fileName;
            }
            $listProduct = ListProduct::where('product_id', $product->id)->first();
            // Tạo sản phẩm mới
            $product = $this->productRepo->update([
                'ten' => $request->ten,
                'loai' => $request->loai,
                'hinhanh' => $fileName,
                'discount_id' => $request->discount_id
            ]);

            // Kiểm tra nếu request có 'soluong', 'gia', 'store_id'
            if ($request->has(['soluong', 'gia', 'store_id'])) {
                // Tạo chi tiết cho list_products
                $details = [
                    'soluong' => $request->soluong,
                    'gia' => $request->gia,
                    'store_id' => $request->store_id,
                    'product_id' => $listProduct->product_id  // Sử dụng ID của sản phẩm vừa tạo
                ];

                // Chèn bản ghi vào bảng list_products
                ListProduct::update($details);
            }

            DB::commit();
            return true;
        } catch (\Exception $err) {
            Log::error($err->getMessage());
            return false;
        }
    }
    public function destroy($id){
        DB::beginTransaction();
        try{
            $product = $this->productRepo->delete($id);
            DB::commit();
            return true;
        }catch (\Exception $e){
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }
}
