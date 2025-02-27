<?php


namespace App\Http\Services;

use App\Models\Product;
use App\http\Repositories\ProductRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProductService{
    protected $productRepo;

    public function __construct(
        ProductRepository $productRepo
    ){
        $this->productRepo = $productRepo;
    }

    public function create($request){
        DB::beginTransaction();
        try{
            $payload = $request->except(['_token','send']);
            $product = $this->productRepo->create($payload);
            DB::commit();
            return true;
        }catch (\Exception $e){
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }
    public function update($request, $id){
        DB::beginTransaction();
        try{
            $payload = $request->except(['_token','send']);
            $product = $this->productRepo->update($payload, $id);
            DB::commit();
            return true;
        }catch (\Exception $e){
            DB::rollBack();
            echo $e->getMessage();die();
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




