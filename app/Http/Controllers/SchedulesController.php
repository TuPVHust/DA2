<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\User;
use App\Models\Truck;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SchedulesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todayDoingSchedules = Schedule::where('date', Carbon::today('Asia/Bangkok'))->where('status',1)->orderBy('id','desc')->get();
        $todayCompltedSchedules = Schedule::where('date', Carbon::today('Asia/Bangkok'))->where('status',0)->orderBy('id','desc')->get();
        $inQueueSchedules = Schedule::where('date','!=',Carbon::today('Asia/Bangkok'))->where('status',1)->orderBy('id','desc')->get();
        // dd($todayDoingSchedules);
        $schedules = Schedule::all();
        return view('boss.schedule.index',[
            'todayDoingSchedules' => $todayDoingSchedules,
            'todayCompltedSchedules' => $todayCompltedSchedules,
            'inQueueSchedules' => $inQueueSchedules,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $trucks = Truck::where('status',1)->get();
        $drivers = User::where('role',0)->where('status',1)->get();
        return view('boss.schedule.create',[
            'trucks' => $trucks,
            'drivers' => $drivers,
        ]);
    }
    // public function addToQueue()
    // {
    //     $trucks = Truck::where('status',1)->get();
    //     $drivers = User::where('role',0)->where('status',1)->get();
    //     return view('boss.schedule.add_to_queue',[
    //         'trucks' => $trucks,
    //         'drivers' => $drivers,
    //     ]);
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->validate([
            'init_money' => 'required|numeric',
            'shift' => 'required|in:0,1',
            'driver'=>'required|numeric',
            'truck'=>'required|numeric',
            'date' => 'required|date_format:d-m-Y'
        ],
        [
            'init_money.required' => 'Cần nhập số tiền cấp cho lái xe',
            'shift.required' => 'Cần nhập ca làm việc',
            'driver.required' => 'Cần nhập lái xe',
            'truck.required' => 'Cần nhập xe',
            'date.required' => 'Cần nhập ngày cho lệnh điều xe',
            'init_money.numeric' => 'Số tiền cần là số (vnđ)',
            'driver.numeric' => 'Nhập lái xe không đúng định dạng',
            'truck.numeric' => 'Nhập xe không đúng định dạng',
            'shift.in' => 'Nhập ca không đúng định dạng',
            'date.date_format' =>  'Nhập ngày tháng không đúng định dạng',
            'date.required' =>  'Cần nhập ngày tháng',
        ]
        )){
            $schedule = Schedule::create([
                'description' => $request->input('description'),
                'driver_id' => $request->input('driver'),
                'truck_id' => $request->input('truck'),
                'car_owner_id' => Truck::find($request->input('truck'))->owner->id,
                'date' => date('Y-m-d',strtotime($request->input('date'))),
                'shift' => $request->input('shift'),
                'init_money' => $request->input('init_money'),
            ]); 
            return redirect()->route('boss.schedule.index')->with('alert-success','Thêm mới thành công.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule)
    {
        $trucks = Truck::where('status',1)->get();
        $drivers = User::where('role',0)->where('status',1)->get();
        return view('boss.schedule.edit',[
            'schedule' => $schedule,
            'trucks' => $trucks,
            'drivers' => $drivers,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {
        if($request->validate([
            'init_money' => 'required|numeric',
            'shift' => 'required|in:0,1',
            'driver'=>'required|numeric',
            'truck'=>'required|numeric',
            'date' => 'required|date_format:d-m-Y',
            'status' => 'required|in:0,1',
        ],
        [
            'init_money.required' => 'Cần nhập số tiền cấp cho lái xe',
            'shift.required' => 'Cần nhập ca làm việc',
            'driver.required' => 'Cần nhập lái xe',
            'truck.required' => 'Cần nhập xe',
            'date.required' => 'Cần nhập ngày cho lệnh điều xe',
            'init_money.numeric' => 'Số tiền cần là số (vnđ)',
            'driver.numeric' => 'Nhập lái xe không đúng định dạng',
            'truck.numeric' => 'Nhập xe không đúng định dạng',
            'shift.in' => 'Nhập ca không đúng định dạng',
            'date.date_format' =>  'Nhập ngày tháng không đúng định dạng',
            'date.required' =>  'Cần nhập ngày tháng',
            'status.required' => 'trạng thái không tồn tại',
            'status.in' => 'trạng thái không hợp lệ',
        ]
        )){
            $schedule->update([
                'description' => $request->input('description'),
                'driver_id' => $request->input('driver'),
                'truck_id' => $request->input('truck'),
                'car_owner_id' => Truck::find($request->input('truck'))->owner->id,
                'date' => date('Y-m-d',strtotime($request->input('date'))),
                'shift' => $request->input('shift'),
                'init_money' => $request->input('init_money'),
                'status' => $request->input('status'),
            ]); 
            return redirect()->route('boss.schedule.index')->with('alert-success','Cập nhật thành công.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        if($schedule->schedule_details->count()==0 && $schedule->cost_details->count()==0)
        {
            $schedule->delete();
        return redirect()->route('boss.schedule.index')->with('alert-success','Xóa bản ghi thành công.');
        }
        else{
            return redirect()->route('boss.schedule.index')->with('alert-danger','Xóa không thành công do có tồn tại chuyến hoặc chi phí.');
        }
    }
}
