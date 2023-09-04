<?php

namespace App\Services;


use App\Exceptions\AttendanceException;
use App\Models\Attendance;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;


class AttendanceService
{

    /**
     * @return void
     */
    public function create(Request $request): void
    {
        
        try {
            DB::beginTransaction();

            $activeAttendance = Attendance::where('user_id', Auth::id())->whereNull('leave')->first();


            if($activeAttendance){
    
                $activeAttendance->update([
                    'leave' => Carbon::now()
                ]);
    
            } else {
    
                Attendance::create([
                    'user_id' => Auth::id(),
                    'enter' => Carbon::now()
                ]);
            }  
    
            Session::flash('success_message', __('attendance.success')); 

            DB::commit();

        } catch (Exception $e) {

            DB::rollBack();
            Log::error('timbratira fallita', [$e->getMessage()]);
            throw new AttendanceException();
        
        }
    }

}