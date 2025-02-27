<?php

namespace App\Http\Controllers;

use App\Http\Repositories\DiscountRepository;
use App\Models\Product;
use App\Http\Repositories\ProductRepository;
use App\Http\Services\ProductService;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Discount;

class ProductController extends Controller
{
    protected $productRepo;
    protected $productSer;
    protected $disRepository;

    public function __construct(
        ProductService $productSer,
        ProductRepository $productRepo,
        DiscountRepository $disRepository

    ){
        $this->productSer = $productSer;
        $this->productRepo = $productRepo;
        $this->disRepository = $disRepository;
    }
    public function indexProduct(Request $request){
        $product = Product::paginate(15);
        return view('productindex', compact('product'));
    }

    public function createProduct(){
        $dis= $this->disRepository->all();
        $template = 'productcreate';
        $config['method'] = 'create';
        return view('productcreate', compact('template', 'dis' ,'config'));
    }

    public function storeProduct(ProductRequest $request)
    {
        if ($this->productSer->create($request)) {
            toastify()->success('Thêm mới bản ghi thành công.');
            return redirect()->route('product.index');
        }
        toastify()->error('Thêm mới bản ghi không thành công.');
        return redirect()->route('product.index');
    }

    public function editProduct($id){
        $product = $this->productRepo->findById($id);
        $dis= $this->disRepository->all();
        $template = 'productcreate';
        $config['method'] = 'edit';
        return view('productcreate', compact('template','product', 'dis' ,'config'));
    }
    public function updateProduct(UpdateProductRequest $request, $id){
        if ($this->productSer->update($request, $id)) {
            toastify()->success('Cập nhật bản ghi thành công.');
            return redirect()->route('product.index');
        }
        toastify()->error('Cập nhật  bản ghi không thành công.');
        return redirect()->route('product.index');
    }
    public function deleteProduct($id){
        $product = $this->productRepo->findById($id);
        $template = 'productdelete';
        return view('productdelete', compact('template',  'product'));
    }
    public function destroyProduct($id){
        if ($this->productSer->destroy($id)){
            toastify()->success('Xoá bản ghi thành công.');
            return redirect()->route('product.index');
        }
        toastify()->success('Xoá bản ghi không thành công.');
        return redirect()->route('product.index');
    }
}
