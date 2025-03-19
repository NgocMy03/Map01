<!DOCTYPE html>
@toastifyCss
<html>

<head>
    <base href="{{ env('APP_URL') }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sản phẩm</title>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/customize.css') }}" rel="stylesheet">
</head>

<body>
    <div id="wrapper">
        <div class="gray-bg">
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-8">
                    <h2>Quản lý sản phẩm</h2>
                    <ol class="breadcrumb" style="margin-bottom: 10px">
                        <li class="active"><strong>Quản lý sản phẩm</strong></li>
                    </ol>
                </div>

                <div class="col-lg-1 col-lg-offset-3 p-2"
                    style="border: 1px solid black; padding: 5px; width: 30px; font-size: 2rem; margin-top:30px; margin-right:10px;">
                    <a id="back-to-home" href="{{ route('Home') }}" title="Về trang chủ"><i class="fa fa-home"></i></a>
                </div>
                <div class="col-lg-1 p-2"
                    style="border: 1px solid black; padding: 5px; width: 30px; font-size: 2rem; margin-top:30px;">
                    <a id="select-sche" href="{{ route('schedule.index') }}" title="Lịch làm việc"><i
                            class="fa fa-calendar"></i></a>
                </div>
                <div class="col-lg-1 p-2"
                    style="border: 1px solid black; padding: 5px; width: 30px; font-size: 2rem; margin-top:30px; margin-left:10px;">
                    <a id="select-sche" href="{{ route('logout') }}" title="Lịch làm việc"><i
                            class="fa fa-sign-out"></i></a>
                </div>
                <div class="text-right" style="margin: 5px 10px -3px;">
                    <strong><span>Xin chào: {{ Auth::guard('staff')->user()->ten }}</span></strong>
                </div>
            </div>


            <div class="row mt20">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Danh sách sản phẩm</h5>
                        </div>

                        <div class="ibox-content">
                            <form action="{{ route('product.index') }}" method="GET">
                                <div class="filter-wrapper">
                                    <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                        <div class="perpage">
                                            <div class="uk-flex uk-flex-middle uk-flex-space-between"></div>
                                        </div>
                                        <div class="action">
                                            <div class="uk-flex uk-flex-middle">
                                                <div class="uk-search uk-flex uk-flex-middle mr10">
                                                    <div class="input-group">
                                                    </div>
                                                </div>
                                                <a href="{{ route('product.create') }}" class="btn btn-danger"><i
                                                        class="fa fa-plus mr5"></i>Thêm mới sản phẩm</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 90px;">Hình ảnh</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Loại sản phẩm</th>
                                        <th>Mã giảm giá</th>
                                        <th>Số lượng tồn</th>
                                        <th>Giá</th>
                                        <th>Cửa hàng</th>
                                        <th class="text-center">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($product) && $product->isNotEmpty())
                                        @foreach ($product as $prod)
                                            <tr>
                                                <td>
                                                    <span class="image image-cover">
                                                        <img src="{{ asset('assets/img/product/' . $prod->hinhanh) }}"
                                                            alt="avt">
                                                    </span>
                                                </td>
                                                <td>{{ $prod->ten }}</td>
                                                <td>{{ $prod->loai }}</td>
                                                <td>{{ $prod->discount->chuongtrinhKM }}</td>
                                                @if ($prod->listproduct->isNotEmpty())
                                                    @foreach ($prod->listproduct as $list)
                                                        <td class="stock-warning" data-stock="{{ $list->soluong }}"
                                                            data-min-stock="10">{{ $list->soluong }}</td>
                                                        <td>{{ $list->gia }}</td>
                                                        <td>{{ $list->store->ten }}</td>
                                                    @endforeach
                                                @endif
                                                {{-- <td>{{$prod->listproduct->store->ten}}</td> --}}
                                                <td class="text-center">
                                                    <a href="{{ route('product.edit', $prod->id) }}"
                                                        class="btn btn-success"><i class="fa fa-edit"></i></a>
                                                    <form action="{{ route('product.delete', $prod->id) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger"
                                                            onclick="return confirm('Bạn có chắc chắn muốn xóa mục này?')">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            {{ $product->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
            {{-- <footer>
                <div class="footer">
                    <div class="text-center">
                        <small> &copy;Copyright: CT298 - N01</small>
                    </div>
                </div>
            </footer> --}}
            {{--  --}}
        </div>
        <div class="footer">
            <div class="pull-right">
                10GB of <strong>250GB</strong> Free.
            </div>
            <div>
                <strong>Copyright</strong> Example Company &copy; 2014-2017
            </div>
        </div>
    </div>

</body>

</html>
@toastifyJs

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".stock-warning").forEach(function(element) {
            let stock = parseInt(element.dataset.stock);
            let minStock = parseInt(element.dataset.minStock);

            if (stock <= minStock) {
                element.classList.add("text-danger", "font-weight-bold");
                element.innerHTML += " <i class='fa fa-exclamation-triangle'></i>";
            }
        });
    });
</script>
