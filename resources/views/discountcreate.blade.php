<!DOCTYPE html>
@toastifyCss
<html>
    <head>
        <base href="{{env('APP_URL')}}">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Khuyến mãi</title>

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
                <h2>Thêm mới khuyến mãi</h2>
                <ol class="breadcrumb" style="margin-bottom: 10px">
                    <li class="active"><strong>Thêm mới khuyến mãi</strong></li>
                </ol>
            </div>
        </div>
    @endif
    @if($config['method'] == 'edit')
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2>Chỉnh sửa thông tin khuyến mãi</h2>
                <ol class="breadcrumb" style="margin-bottom: 10px">
                    <li class="active"><strong>Chỉnh sửa thông tin khuyến mãi</strong></li>
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

    {{-- @php
        $discount_id = isset($discount) ? $discount->id : old('id');
        $chuongtrinhKM = isset($discount) ? $discount->chuongtrinhKM : old('chuongtrinhKM');
        $thoigianapdung = isset($discount) ? $discount->thoigianapdung : old('thoigianapdung');
        $mucgiamgia = isset($discount) ? $discount->mucgiamgia : old('mucgiamgia');
    @endphp --}}

    @php
        $url = ($config['method'] == 'create') ? route('discount.storeDiscount') : route('discount.update', $discount->id);
    @endphp

    <form action="{{ $url }}" method="post" class="box" enctype="multipart/form-data">
        @csrf
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-5">
                    <div class="panel-head">
                        <div class="panel-title">Thông tin khuyến mãi</div>
                        <div class="panel-description">- Nhập thông tin của chương trình khuyến mãi</div>
                        <div class="panel-description">- Bắt buộc nhập đối với những trường <i class="text-danger">(*)</i></div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="ibox">
                        <div class="ibox-content">
                            <div class="row mb15">
                                <div class="col-lg-6">
                                    <div class="form-row">
                                        <label for="" class="control-label text-left">Tên chương trình khuyến mãi<span class="text-danger">(*)</span></label>
                                        <input type="text" name="chuongtrinhKM" value="{{old('chuongtrinhKM', ($discount->chuongtrinhKM) ?? '')}}" class="form-control" placeholder="" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-row">
                                        <label for="" class="control-label text-left">Mức giảm giá<span class="text-danger">(*)</span></label>
                                        <select name="mucgiamgia" class="form-control">
                                            <option value="phantram" {{ old('mucgiamgia', ($discount->mucgiamgia) ?? '') == 'phantram' ? 'selected' : '' }}>Phần trăm</option>
                                            <option value="quatang" {{ old('mucgiamgia', ($discount->mucgiamgia) ?? '') == 'quatang' ? 'selected' : '' }}>Quà tặng</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-row">
                                        <label for="" class="control-label text-left">Thời gian bắt đầu<span class="text-danger">(*)</span></label>
                                        <input type="date" name="thoigianbatdau" value="{{ old('thoigianbatdau', ($discount->thoigianbatdau) ?? '') }}" class="form-control" placeholder="" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-row">
                                        <label for="" class="control-label text-left">Thời gian kết thúc<span class="text-danger">(*)</span></label>
                                        <input type="date" name="thoigianketthuc" value="{{ old('thoigianketthuc', ($discount->thoigianketthuc) ?? '') }}" class="form-control" placeholder="" autocomplete="off">
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
    <footer>
        <div class="footer">
            <div class="text-center">
                <small> &copy;Copyright: CT298 - N01</small>
            </div>
        </div>
    </footer>
</div>
</div>
</body>
</html>
@toastifyJs
