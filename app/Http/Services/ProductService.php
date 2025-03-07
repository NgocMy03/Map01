<?php

namespace App\Http\Services;

use App\Models\Product;
use App\Http\Repositories\ProductRepository;
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
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'price' => 'required|numeric',
                'hinhanh' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            $data = $request->except('_token');

            // Xử lý file ảnh nếu có
            if ($request->hasFile('hinhanh')) {
                $file = $request->file('hinhanh');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('images/products'), $fileName);
                $data['hinhanh'] = 'images/products/' . $fileName;
            }

            Product::create($data);
            return true;
        } catch (\Exception $err) {
            Log::error($err->getMessage());
            return false;
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $product = Product::find($id);
            if (!$product) {
                Log::error("Product with ID $id not found");
                return false;
            }

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'price' => 'required|numeric',
                'hinhanh' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            $data = $request->except('_token');

            // Xử lý file ảnh nếu có
            if ($request->hasFile('hinhanh')) {
                // Xóa ảnh cũ nếu tồn tại
                if ($product->hinhanh && file_exists(public_path($product->hinhanh))) {
                    try {
                        unlink(public_path($product->hinhanh));
                    } catch (\Exception $e) {
                        Log::error("Error deleting old image: " . $e->getMessage());
                    }
                }

                $file = $request->file('hinhanh');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('images/products'), $fileName);
                $data['hinhanh'] = 'images/products/' . $fileName;
            }

            $product->update($data);
            return true;
        } catch (\Exception $err) {
            Log::error($err->getMessage());
            return false;
        }
    }
}
