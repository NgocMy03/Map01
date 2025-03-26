<?php

namespace App\Http\Controllers;

use App\Http\Repositories\DiscountRepository;
use App\Models\Product;
use App\Http\Repositories\ProductRepository;
use App\Http\Repositories\StoreRepository;
use App\Http\Services\ProductService;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Discount;
use App\Models\ListProduct;
use App\Models\Store;

class ProductController extends Controller
{
    protected $productRepo;
    protected $productSer;
    protected $disRepository;
    protected $storeRepository;

    public function __construct(
        ProductService $productSer,
        ProductRepository $productRepo,
        DiscountRepository $disRepository,
        StoreRepository $storeRepository,

    ) {
        $this->productSer = $productSer;
        $this->productRepo = $productRepo;
        $this->disRepository = $disRepository;
        $this->storeRepository = $storeRepository;
    }
    public function indexProduct(Request $request)
    {
        $product = Product::paginate(10);
        return view('productindex', compact('product'));
    }

    public function createProduct()
    {
        $dis = $this->disRepository->all();
        $store = $this->storeRepository->all();
        $template = 'productcreate';
        $config['method'] = 'create';
        return view('productcreate', compact('template', 'dis', 'store', 'config'));
    }

    public function storeProduct(ProductRequest $request)
    {
        if ($this->productSer->create($request)) {
            toastify()->success('Thêm mới bản ghi thành công.');
        } else {
            toastify()->error('Thêm mới bản ghi không thành công.');
        }
        return redirect()->route('product.index');
    }

    public function editProduct($id)
    {
        $product = $this->productRepo->findById($id);
        $dis = $this->disRepository->all();
        $store = $this->storeRepository->all();
        $template = 'productcreate';
        $config['method'] = 'edit';
        return view('productcreate', compact('template', 'product', 'dis', 'store', 'config'));
    }
    public function updateProduct(UpdateProductRequest $request, $id)
    {
        if ($this->productSer->update($request, $id)) {
            toastify()->success('Cập nhật bản ghi thành công.');
        } else {
            toastify()->error('Cập nhật  bản ghi không thành công.');
        }
        return redirect()->route('product.index');
    }
    public function deleteProduct($id)
    {
        $product = $this->productRepo->findById($id);
        if ($this->productSer->destroy($id)) {
            toastify()->success('Xoá bản ghi thành công.');
            return redirect()->route('product.index');
        }
        toastify()->success('Xoá bản ghi không thành công.');
        return redirect()->route('product.index');
    }

    public function getProducts()
    {
        // Lấy tất cả sản phẩm từ bảng products
        $list = ListProduct::all();

        // Khởi tạo mảng để lưu dữ liệu kết hợp
        $combinedData = [];

        foreach ($list as $item) {
            // Lấy thông tin sản phẩm
            $product = Product::find($item->product_id);
            // Lấy thông tin cửa hàng
            $store = Store::find($item->store_id);

            if ($product && $store) {
                $combinedData[] = [
                    'product_id' => $product->id,
                    'product_ten' => $product->ten,
                    'discount_id' => $product->discount_id,
                    'store_id' => $store->id,
                    'store_ten' => $store->ten,
                    // 'coords' => $store->coords,
                    // 'popupContent' => $store->popupContent,
                ];
            }
        }

        // Trả về dữ liệu kết hợp dưới dạng JSON
        return response()->json($combinedData);
    }

}
