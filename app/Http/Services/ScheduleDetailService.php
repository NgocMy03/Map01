<?php

namespace App\Http\Services;

use App\Http\Repositories\ScheduleDetailRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


/**
 * Class CustomerService
 * @package App\Services
 */
class ScheduleDetailService {
    protected $ScheRepo;

    public function __construct(
        ScheduleDetailRepository $ScheRepo
    ){
        $this->ScheRepo = $ScheRepo;
    }

    public function create($request){
        DB::beginTransaction();
        try{
            $payload = $request->except(['_token','send']);
            $Sches = $this->ScheRepo->create($payload);
            DB::commit();
            return true;
        }catch (\Exception $e){
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }
    public function update($request, $id){
        DB::beginTransaction();
        try{
            $payload = $request->except(['_token','send']);
            $Sches = $this->ScheRepo->update($payload, $id);
            DB::commit();
            return true;
        }catch (\Exception $e){
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }
    public function destroy($id){
        DB::beginTransaction();
        try{
            $Sches = $this->ScheRepo->delete($id);
            DB::commit();
            return true;
        }catch (\Exception $e){
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }
}
