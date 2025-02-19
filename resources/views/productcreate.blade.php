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
@if($config['method'] == 'create')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Thêm mới khách hàng</h2>
            <ol class="breadcrumb" style="margin-bottom: 10px">
                <li>
                    <a href="http://localhost:8080/dasboard/index">Dashboard</a>
                </li>
                <li class="active"><strong>Thêm mới khách hàng</strong></li>
            </ol>
        </div>
    </div>
@endif
@if($config['method'] == 'edit')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Chỉnh sửa thông tin khách hàng</h2>
            <ol class="breadcrumb" style="margin-bottom: 10px">
                <li>
                    <a href="http://localhost:8080/dasboard/index">Dashboard</a>
                </li>
                <li class="active"><strong>Chỉnh sửa thông tin khách hàng</strong></li>
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
    $url = ($config['method'] == 'create') ? route('product.storeProduct') : route('product.update', $product->id);
@endphp
<form action="{{ $url }}" method="post" class="box">
    @csrf
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-5">
                <div class="panel-head">
                    <div class="panel-title">Thông tin chung</div>
                    <div class="panel-description">- Nhập thông tin chung của người sử dụng</div>
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
                                    <label for="" class="control-label text-left">Loại sản phẩm<span class="text-danger">(*)</span></label>
                                    <input type="text" name="loai" value="{{old('loai', ($product->loai) ?? '')}}" class="form-control" placeholder="" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Giá<span class="text-danger">(*)</span></label>
                                    <input type="number" name="gia" value="{{old('gia', ($product->gia) ?? '')}}" class="form-control" placeholder="" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Số lượng tồn</label>
                                    <input type="number" name="soluongton" value="{{old('soluongton', ($product->soluongton) ?? '')}}" class="form-control" placeholder="" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        @if($config['method'] == 'create')
                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Mật khẩu<span class="text-danger">(*)</span></label>
                                    <input type="password" name="password" value="" class="form-control" placeholder="" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Nhập lại mật khẩu<span class="text-danger">(*)</span></label>
                                    <input type="password" name="repassword" value="" class="form-control" placeholder="" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        @endif
                        @php
                            $roleCus = [
                                'default' => 'Chọn nhóm khách hàng',  // Key mặc định cho nhóm không chọn
                                'normal' => 'Khách hàng thường',
                                'vip' => 'Khách hàng VIP',
                            ];
                        @endphp
                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Khuyến mãi<span class="text-danger">(*)</span></label>
                                    <select name="role" class="form-control">
                                        @foreach($roleCus as $key => $item)
                                            <option @if(old('discount_id', ($product->discount_id) ?? '') == $key) selected @endif value="{{ $key }}">{{ $item  }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Hình ảnh</label>
                                    <input type="text" name="hinhanh" value="{{old('avatar', ($product->hinhanh) ?? '')}}" class="form-control" placeholder="" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        {{-- <div class="row">
            <div class="col-lg-5">
                <div class="panel-head">
                    <div class="panel-title">Thông tin liên hệ</div>
                    <div class="panel-description">- Nhập thông tin liên hệ của người sử dụng</div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Số điện thoại<span class="text-danger">(*)</span></label>
                                    <input type="text" name="number" value="{{old('number', ($cus->number) ?? '')}}" class="form-control" placeholder="" autocomplete="off">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div> --}}
        <div class="text-right mb15">
            <button class="btn btn-primary" type="submit" name="send" value="send">Lưu</button>
        </div>
    </div>
</form>
</body>
</html>
@toastifyJs
