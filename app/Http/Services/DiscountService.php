<?php

namespace App\Http\Services;

use App\Models\Discount;
use App\Http\Repositories\DiscountRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;


class DiscountService{
    protected $discountRepo;

    public function __construct(DiscountRepository $discountRepo)
    {
        $this->discountRepo = $discountRepo;
    }

    public function create(Request $request)
    {
        try {
            DB::beginTransaction();

            // Tạo chương trình khuyến mãi mới
            $discount = Discount::create([
                'chuongtrinhKM' => $request->chuongtrinhKM,
                'thoigianapdung' => $request->thoigianapdung,
                'mucgiamgia' => $request->mucgiamgia
            ]);

            DB::commit();
            return $discount;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return false;
        }
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $discount = Discount::findOrFail($id);
            $discount->update([
                'chuongtrinhKM' => $request->chuongtrinhKM,
                'thoigianapdung' => $request->thoigianapdung,
                'mucgiamgia' => $request->mucgiamgia
            ]);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return false;
        }
    }
    public function destroy($id){
        DB::beginTransaction();
        try{
            $discount = $this->discountRepo->delete($id);
            DB::commit();
            return true;
        }catch (\Exception $e){
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }
}
