{{-- @php
    dd($schedule);
@endphp --}}
<!DOCTYPE html>
@toastifyCss
<html>

<head>
    <base href="{{ env('APP_URL') }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Lịch làm việc</title>

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
                    <h2>Quản lý lịch làm việc</h2>
                    <ol class="breadcrumb" style="margin-bottom: 10px">
                        <li class="active"><strong>Quản lý lịch làm việc</strong></li>
                    </ol>
                </div>

                <div class="col-lg-1 col-lg-offset-3 p-2"
                    style="border: 1px solid black; padding: 5px; width: 30px; font-size: 2rem; margin-top:30px; margin-right:10px;">
                    <a id="back-to-home" href="{{ route('Home') }}" title="Về trang chủ"><i class="fa fa-home"></i></a>
                </div>
                <div class="col-lg-1 p-2"
                    style="border: 1px solid black; padding: 5px; width: 30px; font-size: 2rem; margin-top:30px;">
                    <a id="select-product" href="{{ route('product.index') }}" title="Sản phẩm"><i
                            class="fa fa-plus"></i></a>
                </div>
            </div>


            <div class="row mt20">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Danh sách lịch làm việc</h5>
                        </div>

                        <div class="ibox-content">
                            <form action="{{ route('schedule.index') }}" method="GET">
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
                                                <a href="{{ route('schedule.create') }}" class="btn btn-danger"><i
                                                        class="fa fa-plus mr5"></i>Thêm mới lịch làm việc</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Tên lịch làm việc</th>
                                        <th>Chức vụ</th>
                                        <th>Tên nhân viên</th>
                                        <th>Cửa hàng</th>
                                        <th>Khung giờ</th>
                                        <th>Ngày làm</th>
                                        <th class="text-center">Thao tác</th>
                                    </tr>
                                </thead>
                                @foreach ($schedule as $dewa)
                                    <tbody>
                                        <tr>
                                            <td>{{ $dewa->ten }}</td>
                                            <td>{{ $dewa->cv }}</td>
                                            <td>{{ $dewa->tennv }}</td>
                                            <td>{{ $dewa->ts }}</td>
                                            <td>{{ $dewa->thoigianbatdau }} - {{ $dewa->thoigianketthuc }}</td>
                                            <td>{{ $dewa->ngay }}</td>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('schedule.edit', $dewa->schedule_details_id) }}"
                                                    class="btn btn-success"><i class="fa fa-edit"></i></a>
                                                <form action="{{ route('schedule.delete', $dewa->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('Bạn có chắc chắn muốn xóa mục này?')">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    </tbody>
                                @endforeach
                            </table>
                            {{ $schedule->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
@toastifyJs
