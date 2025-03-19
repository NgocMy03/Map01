<!DOCTYPE html>
@toastifyCss
<html>
    <head>
        <base href="{{env('APP_URL')}}">
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
        @if($config['method'] == 'create')
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2>Thêm mới sản phẩm</h2>
                <ol class="breadcrumb" style="margin-bottom: 10px">
                    <li class="active"><strong>Thêm mới sản phẩm</strong></li>
                </ol>
            </div>
        </div>
    @endif
    @if($config['method'] == 'edit')
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2>Chỉnh sửa thông tin sản phẩm</h2>
                <ol class="breadcrumb" style="margin-bottom: 10px">
                    <li class="active"><strong>Chỉnh sửa thông tin sản phẩm</strong></li>
                </ol>
            </div>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @php
        //$currentDate = date('Y-m-d');
        $discount_id = isset($product) ? $product->discount_id : old('discount_id');
        $gia = isset($product) ? $product->listproduct->first()->gia : old('gia');
        $soluong = isset($product) ? $product->listproduct->first()->soluong : old('soluong');
        $store_id = isset($product) ? $product->listproduct->first()->store_id : old('store_id');
    @endphp

    @php
        $url = ($config['method'] == 'create') ? route('product.storeProduct') : route('product.update', $product->id);
    @endphp

    <form action="{{ $url }}" method="post" class="box" enctype="multipart/form-data">
        @csrf
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-5">
                    <div class="panel-head">
                        <div class="panel-title">Thông tin chung</div>
                        <div class="panel-description">- Nhập thông tin chung của sản phẩm</div>
                        <div class="panel-description">- Bắt buộc nhập đối với những trường <i class="text-danger">(*)</i></div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="ibox">
                        <div class="ibox-content">
                            <div class="row mb15">
                                <div class="col-lg-6">
                                    <div class="form-row">
                                        <label for="" class="control-label text-left">Tên sản phẩm<span class="text-danger">(*)</span></label>
                                        <input type="text" name="ten" value="{{old('ten', ($product->ten) ?? '')}}" class="form-control" placeholder="" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-row">
                                        <label for="" class="control-label text-left">Giá<span class="text-danger">(*)</span></label>
                                        <input type="text" name="gia" value="{{ old('gia', $gia)}}" class="form-control" placeholder="" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb15">
                                <div class="col-lg-6">
                                    <div class="form-row">
                                        <label for="" class="control-label text-left">Loại sản phẩm<span class="text-danger">(*)</span></label>
                                        <input type="text" name="loai" value="{{old('loai', ($product->loai) ?? '')}}" class="form-control" placeholder="" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-row">
                                        <label for="" class="control-label text-left">Ảnh sản phẩm</label>
                                        <input type="file" name="hinhanh" class="form-control" accept="image/*">
                                        @if(isset($product) && $product->hinhanh)
                                            <small class="form-text text-muted">Ảnh hiện tại: {{$product->hinhanh}}</small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row mb15">
                                <div class="col-lg-6">
                                    <div class="form-row">
                                        <label for="" class="control-label text-left">Số lượng</label>
                                        <input type="text" name="soluong" value="{{old('soluong', $soluong)}}" class="form-control" placeholder="" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-row">
                                        <label for="" class="control-label text-left">Khuyến mãi<span class="text-danger">(*)</span></label>
                                        <select name="discount_id" class="form-control">
                                            <option value="0">Chọn khuyến mãi</option>
                                                @if(isset($dis))
                                                    @foreach($dis as $d)
                                                        <option {{ $discount_id == $d->id ? 'selected' : '' }} value="{{$d->id}}">{{$d->chuongtrinhKM}}</option>
                                                    @endforeach
                                                @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb15">
                                <div class="col-lg-6">
                                    <div class="form-row">
                                        <label for="" class="control-label text-left">Cửa hàng<span class="text-danger">(*)</span></label>
                                        <select name="store_id" class="form-control">
                                            <option value="0">Chọn cửa hàng</option>
                                                @if(isset($store))
                                                    @foreach($store as $st)
                                                        <option {{ $store_id == $st->id ? 'selected' : '' }} value="{{$st->id}}">{{$st->ten}}</option>
                                                    @endforeach
                                                @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-right mb15">
                <button class="btn btn-primary" type="submit" name="send" value="send">Lưu</button>
            </div>
        </div>
    </form>
</div>
</div>
</body>
</html>
@toastifyJs
