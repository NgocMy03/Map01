<?php

namespace App\Http\Controllers;

use App\Http\Repositories\ScheduleDetailRepository;
use App\Http\Repositories\ScheduleRepository;
use App\Http\Repositories\StaffRepository;
use App\Http\Repositories\StoreRepository;
use App\Http\Services\ScheduleDetailService;
use App\Http\Requests\ScheduleRequest;
use App\Http\Requests\UpdateScheduleRequest;
use App\Models\Schedule;
use App\Models\ScheduleDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    protected $scheduleRepo;
    protected $scheduleSer;
    protected $staffRepository;
    protected $scheRepository;

    public function __construct(
        ScheduleDetailService $scheduleSer,
        ScheduleDetailRepository $scheduleRepo,
        StaffRepository $staffRepository,
        ScheduleRepository $scheRepository,
    ) {
        $this->scheduleSer = $scheduleSer;
        $this->scheduleRepo = $scheduleRepo;
        $this->staffRepository = $staffRepository;
        $this->scheRepository = $scheRepository;
    }

    public function indexSchedule(Request $request)
    {
        // $schedule = Schedule::paginate(10);
        $schedule = DB::table('schedules')
            ->join('schedule_details', 'schedules.id', '=', 'schedule_details.schedule_id')
            ->join('staff', 'staff.id', '=', 'schedule_details.staff_id')
            ->join('stores', 'stores.id', '=', 'staff.store_id')
            ->select(
                'schedules.*',
                'stores.ten as ts',
                'staff.ten as tennv',
                'staff.chucvu as cv',
                'staff.status',
                'schedule_details.id as schedule_details_id',
                'schedule_details.schedule_id as schedule_id',
                'schedule_details.ngay as ngay'
            )
            ->paginate(10);
        return view('scheduleindex', compact('schedule'));
    }

    public function createSchedule()
    {
        $staffs = $this->staffRepository->all();
        // $sche = $this->scheRepository->all();
        $schedules = DB::table('schedules')->get();
        $sche = DB::table('schedules')->get();
        $template = 'schedulecreate';
        return view('schedulecreate', compact('template', 'staffs', 'sche', 'schedules'));
    }

    public function storeSchedule(ScheduleRequest $request)
    {
        // dd($request->all());
        if ($this->scheduleSer->create($request)) {
            toastify()->success('Thêm mới bản ghi thành công.');
        } else {
            toastify()->error('Thêm mới bản ghi không thành công.');
        }
        return redirect()->route('schedule.index');
    }

    public function editSchedule($id)
    {
        // $schedule = $this->scheduleRepo->findById($id);
        // $staff = $this->staffRepository->all();
        // $sche = $this->scheRepository->all();
        // $scheduleOfStaff = DB::table('schedules')
        //     ->join('schedule_details', 'schedules.id', '=', 'schedule_details.schedule_id')
        //     ->where('schedule_details.staff_id', $id)
        //     ->select(
        //         'schedules.*',
        //         'schedule_details.schedule_id as schedule_id',
        //     )
        //     ->get();
        $scheduleOfStaff = DB::table('schedule_details')
            ->find($id);
        $staff = DB::table('staff')
            ->join('schedule_details', 'staff.id', '=', 'schedule_details.staff_id')
            ->where('schedule_details.id', $id)
            ->select(
                'staff.*',
                'schedule_details.schedule_id as schedule_id'
            )->get();
        $sche = DB::table('schedules')->get();
        $template = 'schedulecreate';
        // $config['method'] = 'edit';
        // dd($schedule, $staff, $sche, $config, $template);
        return view('scheduleupdate', compact('template', 'scheduleOfStaff', 'sche', 'staff'));
    }

    public function updateSchedule(UpdateScheduleRequest $request, $id)
    {
        // dd($request->all());
        if ($this->scheduleSer->update($request, $id)) {
            toastify()->success('Cập nhật bản ghi thành công.');
        } else {
            toastify()->error('Cập nhật bản ghi không thành công.');
        }
        return redirect()->route('schedule.index');
    }


    public function deleteSchedule($id)
    {
        $schedule = $this->scheduleRepo->findById($id);

        if ($this->scheduleSer->destroy($id)) {
            toastify()->success('Xoá bản ghi thành công.');
            return redirect()->route('schedule.index');
        }
        toastify()->error('Xoá bản ghi không thành công.');
        return redirect()->route('schedule.index');
    }
}
