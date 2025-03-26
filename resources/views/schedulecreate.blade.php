@php
    // $sche = DB::table('schedules')->get();
    // dd($sche);
    // dd($schedule);
@endphp
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
                    <h2>Thêm mới lịch làm việc</h2>
                    <ol class="breadcrumb" style="margin-bottom: 10px">
                        <li class="active"><strong>Thêm mới lịch làm việc</strong></li>
                    </ol>
                </div>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif





            <form action="{{ route('schedule.storeSchedule') }}" method="post" class="box"
                enctype="multipart/form-data">
                @csrf
                <div class="wrapper wrapper-content animated fadeInRight">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="panel-head">
                                <div class="panel-title">Thông tin chung</div>
                                <div class="panel-description">- Nhập thông tin chung của lịch làm việc</div>
                                <div class="panel-description">- Bắt buộc nhập đối với những trường <i
                                        class="text-danger">(*)</i></div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="ibox">
                                <div class="ibox-content">
                                    <div class="row mb15">
                                        <div class="col-lg-6">
                                            <div class="form-row">
                                                <label for="" class="control-label text-left">Ngày làm việc<span
                                                        class="text-danger">(*)</span></label>
                                                <input type="date" name="ngay" value="" class="form-control"
                                                    placeholder="" autocomplete="off">
                                                @error('date')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-row">
                                                <label for="" class="control-label text-left">Ca làm việc<span
                                                        class="text-danger">(*)</span></label>
                                                <select name="schedule_id" class="form-control js-single-setup">
                                                    @foreach ($schedules as $schedule)
                                                        <option value="{{ $schedule->id }}">
                                                            {{ $schedule->ten . ' - ' . $schedule->thoigianbatdau . '-' . $schedule->thoigianketthuc }}
                                                        </option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb15">

                                        <div class="col-lg-6">
                                            <div class="form-row">
                                                <label for="" class="control-label text-left">Nhân viên<span
                                                        class="text-danger">(*)</span></label>

                                                <select name="staff_id" class="form-control js-single-setup">
                                                    @foreach ($staffs as $staff)
                                                        <option value="{{ $staff->id }}">{{ $staff->ten }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-right mb15">
                        <input class="btn btn-primary" type="submit" name="send" value="Lưu">
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
