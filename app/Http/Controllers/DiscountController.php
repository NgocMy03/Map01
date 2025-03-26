<?php

namespace App\Http\Controllers;

use App\Http\Repositories\DiscountRepository;
use App\Models\Discount;
// use App\Http\Repositories\StoreRepository;
use App\Http\Services\DiscountService;
use Illuminate\Http\Request;
use App\Http\Requests\DiscountRequest;
use App\Http\Requests\UpdateDiscountRequest;

class DiscountController extends Controller
{
    protected $discountRepo;
    protected $discountSer;
    protected $disRepository;
    // protected $storeRepository;

    public function __construct(
        DiscountService $discountSer,
        DiscountRepository $discountRepo,
        DiscountRepository $disRepository,
        // StoreRepository $storeRepository,

    ) {
        $this->discountSer = $discountSer;
        $this->discountRepo = $discountRepo;
        $this->disRepository = $disRepository;
        // $this->storeRepository = $storeRepository;
    }
    public function indexDiscount(Request $request)
    {
        $discount = Discount::paginate(10);
        return view('discountindex', compact('discount'));
    }

    public function createDiscount()
    {
         $dis = $this->discountRepo->all();
        // $store = $this->storeRepository->all();
        $template = 'discountcreate';
        $config['method'] = 'create';
        return view('discountcreate', compact('template', 'dis', 'config'));
    }

    public function storeDiscount(DiscountRequest $request)
    {
        if ($this->discountSer->create($request)) {
            toastify()->success('Thêm mới bản ghi thành công.');
        } else {
            toastify()->error('Thêm mới bản ghi không thành công.');
        }
        return redirect()->route('discount.index');
    }

    public function editDiscount($id)
    {
        $discount = $this->discountRepo->findById($id);
        // $dis = $this->disRepository->all();
        // $store = $this->storeRepository->all();
        $template = 'discountcreate';
        $config['method'] = 'edit';
        return view('discountcreate', compact('template', 'discount','config'));
    }
    public function updateDiscount(UpdateDiscountRequest $request, $id)
    {
        if ($this->discountSer->update($request, $id)) {
            toastify()->success('Cập nhật bản ghi thành công.');
        } else {
            toastify()->error('Cập nhật  bản ghi không thành công.');
        }
        return redirect()->route('discount.index');
    }
    public function deleteDiscount($id)
    {
        $discount = $this->discountRepo->findById($id);
        if ($this->discountSer->destroy($id)) {
            toastify()->success('Xoá bản ghi thành công.');
            return redirect()->route('discount.index');
        }
        toastify()->success('Xoá bản ghi không thành công.');
        return redirect()->route('discount.index');
    }

}
