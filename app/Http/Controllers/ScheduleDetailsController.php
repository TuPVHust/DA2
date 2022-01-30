<?php

namespace App\Http\Controllers;

use App\Models\ScheduleDetail;
use App\Models\Schedule;
use App\Models\Category;
use App\Models\Order;
use App\Models\Partner;
use Illuminate\Http\Request;

class ScheduleDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('boss.schedule_detail.index',[
            
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $schedules = Schedule::orderBy('date','desc')->get();
        $categories = Category::all();
        $sellers = Partner::where('NCC',1)->get();
        $buyers = Partner::where('NM',1)->get();
        $orders = Order::all();
        return view('boss.schedule_detail.create',[
            'schedules' => $schedules,
            'categories' => $categories,
            'sellers' => $sellers,
            'buyers' => $buyers,
            'orders' => $orders,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->validate([
            'seller' => 'required|numeric',
            'buyer' => 'required|numeric',
            'order' => 'required',
            'category' => 'required|numeric',
            'price' => 'required|numeric',
            'actual_price' => 'required|numeric',
            'revenue' => 'required|numeric',
            'actual_revenue' => 'required|numeric',
            'quantity' => 'required|numeric',
            'distance' => 'required|numeric',
            'schedule' => 'required|numeric',
        ],
        [
            'seller.required' => 'Cần nhập thông tin này',
            'seller.numeric' => 'Nhập không đúng định dạng',
            'buyer.required' => 'Cần nhập thông tin này',
            'buyer.numeric' => 'Nhập không đúng định dạng',
            'order.required' => 'Cần nhập thông tin này',
            'category.required' => 'Cần nhập thông tin này',
            'category.numeric' => 'Nhập không đúng định dạng',
            'price.required' => 'Cần nhập thông tin này',
            'price.numeric' => 'Nhập không đúng định dạng',
            'actual_price.required' => 'Cần nhập thông tin này',
            'actual_price.numeric' => 'Nhập không đúng định dạng',
            'revenue.required' => 'Cần nhập thông tin này',
            'revenue.numeric' => 'Nhập không đúng định dạng',
            'actual_revenue.required' => 'Cần nhập thông tin này',
            'actual_revenue.numeric' => 'Nhập không đúng định dạng',
            'quantity.required' => 'Cần nhập thông tin này',
            'quantity.numeric' => 'Nhập không đúng định dạng',
            'distance.required' => 'Cần nhập thông tin này',
            'distance.numeric' => 'Nhập không đúng định dạng',
            'schedule.required' => 'Cần nhập thông tin này',
            'schedule.numeric' => 'Nhập không đúng định dạng',
        ]
        )){
            if($request->input('order') !== 'none'){
                $schedule_detail = ScheduleDetail::create([
                    'description' => $request->input('description'),
                    'seller_id' => $request->input('seller'),
                    'buyer_id' => $request->input('buyer'),
                    'order_id' => $request->input('order'),
                    'category_id' => $request->input('category'),
                    'price' => $request->input('price'),
                    'actual_price' => $request->input('actual_price'),
                    'revenue' => $request->input('revenue'),
                    'actual_revenue' => $request->input('actual_revenue'),
                    'quantity' => $request->input('quantity'),
                    'distance' => $request->input('distance'),
                    'schedule_id' => $request->input('schedule'),
                ]);
            }
            else{
                $schedule_detail = ScheduleDetail::create([
                    'description' => $request->input('description'),
                    'seller_id' => $request->input('seller'),
                    'buyer_id' => $request->input('buyer'),
                    'order_id' => null,
                    'category_id' => $request->input('category'),
                    'price' => $request->input('price'),
                    'actual_price' => $request->input('actual_price'),
                    'revenue' => $request->input('revenue'),
                    'actual_revenue' => $request->input('actual_revenue'),
                    'quantity' => $request->input('quantity'),
                    'distance' => $request->input('distance'),
                    'schedule_id' => $request->input('schedule'),
                ]);
            }
            return redirect()->route('boss.schedule_detail.index')->with('alert-success','Thêm mới thành công.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ScheduleDetail  $scheduleDetail
     * @return \Illuminate\Http\Response
     */
    public function show(ScheduleDetail $scheduleDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ScheduleDetail  $scheduleDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(ScheduleDetail $scheduleDetail)
    {
        $schedules = Schedule::orderBy('date','desc')->get();
        $categories = Category::all();
        $sellers = Partner::where('NCC',1)->get();
        $buyers = Partner::where('NM',1)->get();
        $orders = Order::all();
        return view('boss.schedule_detail.edit',[
            'schedules' => $schedules,
            'categories' => $categories,
            'sellers' => $sellers,
            'buyers' => $buyers,
            'orders' => $orders,
            'scheduleDetail' => $scheduleDetail,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ScheduleDetail  $scheduleDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ScheduleDetail $scheduleDetail)
    {
        if($request->validate([
            'seller' => 'required|numeric',
            'buyer' => 'required|numeric',
            'order' => 'required',
            'category' => 'required|numeric',
            'price' => 'required|numeric',
            'actual_price' => 'required|numeric',
            'revenue' => 'required|numeric',
            'actual_revenue' => 'required|numeric',
            'quantity' => 'required|numeric',
            'distance' => 'required|numeric',
            'schedule' => 'required|numeric',
        ],
        [
            'seller.required' => 'Cần nhập thông tin này',
            'seller.numeric' => 'Nhập không đúng định dạng',
            'buyer.required' => 'Cần nhập thông tin này',
            'buyer.numeric' => 'Nhập không đúng định dạng',
            'order.required' => 'Cần nhập thông tin này',
            'category.required' => 'Cần nhập thông tin này',
            'category.numeric' => 'Nhập không đúng định dạng',
            'price.required' => 'Cần nhập thông tin này',
            'price.numeric' => 'Nhập không đúng định dạng',
            'actual_price.required' => 'Cần nhập thông tin này',
            'actual_price.numeric' => 'Nhập không đúng định dạng',
            'revenue.required' => 'Cần nhập thông tin này',
            'revenue.numeric' => 'Nhập không đúng định dạng',
            'actual_revenue.required' => 'Cần nhập thông tin này',
            'actual_revenue.numeric' => 'Nhập không đúng định dạng',
            'quantity.required' => 'Cần nhập thông tin này',
            'quantity.numeric' => 'Nhập không đúng định dạng',
            'distance.required' => 'Cần nhập thông tin này',
            'distance.numeric' => 'Nhập không đúng định dạng',
            'schedule.required' => 'Cần nhập thông tin này',
            'schedule.numeric' => 'Nhập không đúng định dạng',
        ]
        )){
            if($request->input('order') !== 'none'){
                $scheduleDetail->update([
                    'description' => $request->input('description'),
                    'seller_id' => $request->input('seller'),
                    'buyer_id' => $request->input('buyer'),
                    'order_id' => $request->input('order'),
                    'category_id' => $request->input('category'),
                    'price' => $request->input('price'),
                    'actual_price' => $request->input('actual_price'),
                    'revenue' => $request->input('revenue'),
                    'actual_revenue' => $request->input('actual_revenue'),
                    'quantity' => $request->input('quantity'),
                    'distance' => $request->input('distance'),
                    'schedule_id' => $request->input('schedule'),
                ]);
            }
            else{
                $scheduleDetail->update([
                    'description' => $request->input('description'),
                    'seller_id' => $request->input('seller'),
                    'buyer_id' => $request->input('buyer'),
                    'order_id' => null,
                    'category_id' => $request->input('category'),
                    'price' => $request->input('price'),
                    'actual_price' => $request->input('actual_price'),
                    'revenue' => $request->input('revenue'),
                    'actual_revenue' => $request->input('actual_revenue'),
                    'quantity' => $request->input('quantity'),
                    'distance' => $request->input('distance'),
                    'schedule_id' => $request->input('schedule'),
                ]);
            }
            return redirect()->route('boss.schedule_detail.index')->with('alert-success','Cập nhật thành công.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ScheduleDetail  $scheduleDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(ScheduleDetail $scheduleDetail)
    {
        //
    }
}
