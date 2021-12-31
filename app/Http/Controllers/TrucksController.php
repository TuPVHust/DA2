<?php

namespace App\Http\Controllers;

use App\Models\Truck;
use App\Models\Partner;
use Illuminate\Http\Request;

class TrucksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trucks = Truck::all();
        return view ('boss.truck.index',[
            'trucks' => $trucks,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $car_owners = Partner::where('car_owner', 1)->get();
        return view('boss.truck.create',[
            'car_owners' => $car_owners,
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
        // dd('oki');
        if($request->validate([
            'plate'=>'required|unique:trucks,plate|max:9|min:8',
            'figure'=>'required',
            'brand'=>'required',
            'capacity'=>'required|numeric',
            'owner_id'=>'required|numeric',
        ],
        [
            'plate.required' => 'Cần nhập biển số xe',
            'figure.required' => 'Cần nhập loại xe',
            'brand.required' => 'Cần nhập thương hiệu xe',
            'capacity.required' => 'Cần nhập tải trọng xe xe',
            'owner_id.required' => 'Cần nhập chủ xe',
            'plate.unique' => 'Biển số xe đã tồn tại',
            'plate.max' => 'Biển số không đúng định dạng',
            'plate.min' => 'Biển số không đúng định dạng',
            'capacity.numeric' => 'Trọng tải xe cần là số (ví dụ 30 (tấn))',
            'owner_id.numeric' => 'Chủ xe không hợp lệ',
        ]
        )){
            // dd($request);
            $Truck = Truck::create([
                'plate' => $request->input('plate'),
                'figure' => $request->input('figure'),
                'brand' => $request->input('brand'),
                'capacity' => $request->input('capacity'),
                'owner_id' => $request->input('owner_id'),
            ]); 
            return redirect()->route('boss.truck.index')->with('alert-success','Thêm mới thành công.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Truck  $truck
     * @return \Illuminate\Http\Response
     */
    public function show(Truck $truck)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Truck  $truck
     * @return \Illuminate\Http\Response
     */
    public function edit(Truck $truck)
    {
        $car_owners = Partner::where('car_owner', 1)->get();
        return view('boss.truck.edit',[
            'car_owners' => $car_owners,
            'truck' => $truck
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Truck  $truck
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Truck $truck)
    {
        if($request->validate([
            'plate'=>'required|max:9|min:8|unique:trucks,plate,' . $truck->id,
            'figure'=>'required',
            'brand'=>'required',
            'capacity'=>'required|numeric',
            'owner_id'=>'required|numeric',
            'status' => 'required|in:0,1',
        ],
        [
            'plate.required' => 'Cần nhập biển số xe',
            'figure.required' => 'Cần nhập loại xe',
            'brand.required' => 'Cần nhập thương hiệu xe',
            'capacity.required' => 'Cần nhập tải trọng xe xe',
            'owner_id.required' => 'Cần nhập chủ xe',
            'plate.unique' => 'Biển số xe đã tồn tại',
            'plate.max' => 'Biển số không đúng định dạng',
            'plate.min' => 'Biển số không đúng định dạng',
            'capacity.numeric' => 'Trọng tải xe cần là số (ví dụ 30 (tấn))',
            'owner_id.numeric' => 'Chủ xe không hợp lệ',
            'status.required' => 'cần nhập trạng thái cho xe',
            'status.in' => 'trạng thái cho xe không hợp lệ',
        ]
        )){
            // dd($request);
            $truck->update([
                'plate' => $request->input('plate'),
                'figure' => $request->input('figure'),
                'brand' => $request->input('brand'),
                'capacity' => $request->input('capacity'),
                'owner_id' => $request->input('owner_id'),
                'status' => $request->input('status'),
            ]); 
            return redirect()->route('boss.truck.index')->with('alert-success','Chỉnh sửa thành công.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Truck  $truck
     * @return \Illuminate\Http\Response
     */
    public function destroy(Truck $truck)
    {
        $truck->delete();
        return redirect()->route('boss.truck.index')->with('alert-success','Xóa bản ghi thành công.');
    }
}
