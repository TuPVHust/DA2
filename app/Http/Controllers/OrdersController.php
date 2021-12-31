<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Partner;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();
        return view('boss.order.index',[
            'orders' => $orders
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $partners = Partner::where('NM', 1)->get();
        return view('boss.order.create',[
            'partners' => $partners,
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
            'summary'=>'required|unique:orders,summary',
            'partner_id' => 'required|numeric',
            'piority' => 'required|numeric',
        ],
        [
            'summary.required' => 'Cần nhập tóm tắt cho đơn hàng',
            'partner_id.required' => 'Cần nhập người đặt',
            'summary.unique' => 'Tóm tắt cần duy nhất để phân biệt',
            'partner_id.numeric' => 'Người đặt không hợp lệ',
            'piority.numeric' => 'Độ ưu tiên cần là số',
            'piority.required' => 'cần nhập độ ưu tiên',
        ]
        )){
            // dd($request);
            $Order = Order::create([
                'summary' => $request->input('summary'),
                'partner_id' => $request->input('partner_id'),
                'piority' => $request->input('piority'),
                'description' => $request->input('description'),
            ]); 
            return redirect()->route('boss.order.index')->with('alert-success','Thêm mới thành công.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $partners = Partner::where('NM', 1)->get();
        return view('boss.order.edit',[
            'order' => $order,
            'partners' => $partners,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        if($request->validate([
            'summary'=>'required|unique:orders,summary,' . $order->id,
            'partner_id' => 'required|numeric',
            'piority' => 'required|numeric',
            'status' => 'required|in:0,1',
        ],
        [
            'summary.required' => 'Cần nhập tóm tắt cho đơn hàng',
            'partner_id.required' => 'Cần nhập người đặt',
            'summary.unique' => 'Tóm tắt cần duy nhất để phân biệt',
            'partner_id.numeric' => 'Người đặt không hợp lệ',
            'piority.numeric' => 'Độ ưu tiên cần là số',
            'piority.required' => 'cần nhập độ ưu tiên',
            'status.required' => 'trạng thái không tồn tại',
            'status.in' => 'trạng thái không hợp lệ',
        ]
        )){
            // dd($request);
            $order->update([
                'summary' => $request->input('summary'),
                'partner_id' => $request->input('partner_id'),
                'piority' => $request->input('piority'),
                'description' => $request->input('description'),
                'status' => $request->input('status'),
            ]); 
            return redirect()->route('boss.order.index')->with('alert-success','Cập nhật thành công.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('boss.order.index')->with('alert-success','Xóa bản ghi thành công.');
    }
}
