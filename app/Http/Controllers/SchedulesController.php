<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\User;
use App\Models\Truck;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Notifications\createSchedule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

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
            'init_money.required' => 'C???n nh???p s??? ti???n c???p cho l??i xe',
            'shift.required' => 'C???n nh???p ca l??m vi???c',
            'driver.required' => 'C???n nh???p l??i xe',
            'truck.required' => 'C???n nh???p xe',
            'date.required' => 'C???n nh???p ng??y cho l???nh ??i???u xe',
            'init_money.numeric' => 'S??? ti???n c???n l?? s??? (vn??)',
            'driver.numeric' => 'Nh???p l??i xe kh??ng ????ng ?????nh d???ng',
            'truck.numeric' => 'Nh???p xe kh??ng ????ng ?????nh d???ng',
            'shift.in' => 'Nh???p ca kh??ng ????ng ?????nh d???ng',
            'date.date_format' =>  'Nh???p ng??y th??ng kh??ng ????ng ?????nh d???ng',
            'date.required' =>  'C???n nh???p ng??y th??ng',
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
            $staff = User::find($request->input('driver'));
            if($staff){
                \Notification::send($staff, new createSchedule(Auth::user(), $schedule));
            }
            return redirect()->route('boss.schedule.index')->with('alert-success','Th??m m???i th??nh c??ng.');    
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
        //$schedule = Schedule::find($schedule->id);
        if (! Gate::allows('update-schedule', $schedule)) {
            abort(403);
        }
        if($request->validate([
            'init_money' => 'required|numeric',
            'shift' => 'required|in:0,1',
            'driver'=>'required|numeric',
            'truck'=>'required|numeric',
            'date' => 'required|date_format:d-m-Y',
            'status' => 'required|in:0,1',
        ],
        [
            'init_money.required' => 'C???n nh???p s??? ti???n c???p cho l??i xe',
            'shift.required' => 'C???n nh???p ca l??m vi???c',
            'driver.required' => 'C???n nh???p l??i xe',
            'truck.required' => 'C???n nh???p xe',
            'date.required' => 'C???n nh???p ng??y cho l???nh ??i???u xe',
            'init_money.numeric' => 'S??? ti???n c???n l?? s??? (vn??)',
            'driver.numeric' => 'Nh???p l??i xe kh??ng ????ng ?????nh d???ng',
            'truck.numeric' => 'Nh???p xe kh??ng ????ng ?????nh d???ng',
            'shift.in' => 'Nh???p ca kh??ng ????ng ?????nh d???ng',
            'date.date_format' =>  'Nh???p ng??y th??ng kh??ng ????ng ?????nh d???ng',
            'date.required' =>  'C???n nh???p ng??y th??ng',
            'status.required' => 'tr???ng th??i kh??ng t???n t???i',
            'status.in' => 'tr???ng th??i kh??ng h???p l???',
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
            return redirect()->route('boss.schedule.index')->with('alert-success','C???p nh???t th??nh c??ng.');
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
        return redirect()->route('boss.schedule.index')->with('alert-success','X??a b???n ghi th??nh c??ng.');
        }
        else{
            return redirect()->route('boss.schedule.index')->with('alert-danger','X??a kh??ng th??nh c??ng do c?? t???n t???i chuy???n ho???c chi ph??.');
        }
    }
}
