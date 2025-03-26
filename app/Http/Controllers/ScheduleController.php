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
        ->select('schedules.*','stores.ten as ts', 'staff.ten as tennv', 'staff.chucvu as cv', 'schedule_details.*')
        ->where('schedule_details.deleted_at', null)
        ->paginate(10);
        return view('scheduleindex', compact('schedule'));
    }

    public function createSchedule()
    {
        $staff = $this->staffRepository->all();
        // $sche = $this->scheRepository->all();
        $sche = DB::table('schedules')->get();
        $template = 'schedulecreate';
        $config['method'] = 'create';
        return view('schedulecreate', compact('template', 'staff','sche', 'config'));
    }

    public function storeSchedule(ScheduleRequest $request)
    {
        if ($this->scheduleSer->create($request)) {
            toastify()->success('Thêm mới bản ghi thành công.');
        } else {
            toastify()->error('Thêm mới bản ghi không thành công.');
        }
        return redirect()->route('schedule.index');
    }

    public function editSchedule($id)
    {
        $schedule = $this->scheduleRepo->findById($id);
        $staff = $this->staffRepository->all();
        $sche = $this->scheRepository->all();
        $template = 'schedulecreate';
        $config['method'] = 'edit';
        return view('schedulecreate', compact('template', 'schedule', 'staff','sche', 'config'));
    }

    public function updateSchedule(UpdateScheduleRequest $request, $id)
    {
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
