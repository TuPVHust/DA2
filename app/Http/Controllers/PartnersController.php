<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;

class PartnersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $partners = Partner::all();
        return view('boss.partner.index',[
            'partners' => $partners,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('boss.partner.create');
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
            'name'=>'required|unique:partners,name',
            'phone'=>'required|unique:partners,phone|regex:/^([0-9\s\-\+\(\)]*)$/|min:10','digits:10',
            'NCC' => 'required|in:0,1',
            'NM' => 'required|in:0,1',
            'car_owner' => 'required|in:0,1',  
        ],
        [
            'name.required' => 'Cần nhập tên đối tác',
            'phone.required' => 'Cần nhập số điện thoại đối tác',
            'name.unique' => 'Tên đối tác đã tồn tại',
            'phone.unique' => 'Số điện thoại đã tồn tại',
            'phone.digits' => 'Số điện thoại không hợp lệ',
            'phone.regex' => 'Số điện thoại không hợp lệ',
            'NCC.required' => 'Không nhận được kết quả!!',
            'NM.required' => 'Không nhận được kết quả!!',
            'car_owner.required' => 'Không nhận được kết quả!!',
            'NCC.in' => 'Lựa chọn bị lỗi!!',
            'NM.in' => 'Lựa chọn bị lỗi!!',
            'car_owner.in' => 'Lựa chọn bị lỗi!!',
        ]
        )){
            $partner = Partner::create([
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'NCC' => $request->input('NCC'),
                'NM' => $request->input('NM'),
                'car_owner' => $request->input('car_owner'),
            ]); 
            return redirect()->route('boss.partner.index')->with('alert-success','Thêm mới thành công.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function show(Partner $partner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function edit(Partner $partner)
    {
        return view('boss.partner.edit',[
            'partner' => $partner,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Partner $partner)
    {
        // dd($partner);
        if($request->validate([
            'name'=>'required|unique:partners,name,' . $partner->id,
            'phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|digits:10|unique:partners,phone,' . $partner->id,
            'NCC' => 'required|in:0,1',
            'NM' => 'required|in:0,1',
            'car_owner' => 'required|in:0,1',  
        ],
        [
            'name.required' => 'Cần nhập tên đối tác',
            'phone.required' => 'Cần nhập số điện thoại đối tác',
            'name.unique' => 'Tên đối tác đã tồn tại',
            'phone.unique' => 'Số điện thoại đã tồn tại',
            'phone.digits' => 'Số điện thoại không hợp lệ',
            'phone.regex' => 'Số điện thoại không hợp lệ',
            'NCC.required' => 'Không nhận được kết quả!!',
            'NM.required' => 'Không nhận được kết quả!!',
            'car_owner.required' => 'Không nhận được kết quả!!',
            'NCC.in' => 'Lựa chọn bị lỗi!!',
            'NM.in' => 'Lựa chọn bị lỗi!!',
            'car_owner.in' => 'Lựa chọn bị lỗi!!',
        ]
        )){
            $partner->update([
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'NCC' => $request->input('NCC'),
                'NM' => $request->input('NM'),
                'car_owner' => $request->input('car_owner'),
            ]); 
            return redirect()->route('boss.partner.index')->with('alert-success','Cập nhật thành công.');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Partner $partner)
    {
        $partner->delete();
        return redirect()->route('boss.partner.index')->with('alert-success','Xóa bản ghi thành công.');
    }
}
