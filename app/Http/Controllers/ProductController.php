<?php

namespace App\Http\Controllers;

use App\Models\Product as ModelsProduct;
use App\Http\Repositories\ProductRepository;
use App\Http\Services\ProductService;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    protected $productRepo;
    protected $productSer;

    public function __construct(
        ProductService $productSer,
        ProductRepository $productRepo
    ){
        $this->productSer = $productSer;
        $this->productRepo = $productRepo;
    }
    public function indexProduct(Request $request){
        $product = $this->productSer->paginate(15);
        return view('productindex', compact('product'));
    }

    public function createProduct(){
        $template = 'productcreate';
        $config['method'] = 'create';
        return view('productcreate', compact('template', 'config'));
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
        $template = 'productcreate';
        $config['method'] = 'edit';
        return view('productindex', compact('template','product', 'config'));
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
        return view('productindex', compact('template',  'product'));
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
