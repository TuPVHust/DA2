<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Auth;

class DriversController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $drivers = User::where('role', 0)->get();
        return view('boss.driver.index',[
            'drivers' => $drivers,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // public function store(Request $request)
    // {
    //     //
    // }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $driver = User::find($id);
        if($driver)
        {
            return view('boss.driver.edit',[
                'driver' => $driver,
            ]);
        }
        else{
            redirect()->route('boss.driver.index')->with('alert-danger','Tài xế không tồn tại.');
        }  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $driver = User::find($id);
        // dd(Auth::user()->role === 1);
        if (! Gate::allows('update-driver', $driver)) {
            abort(403);
        }
        // dd($driver->id);
        if($request->validate([
            'name'=>'required|unique:users,name,' . $driver->id,
            'phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|digits:10|unique:users,phone,' . $driver->id,
            'status' => 'required|in:0,1',
        ],
        [
            'name.required' => 'Cần nhập tên tài xế',
            'phone.required' => 'Cần nhập số điện thoại tài xế',
            'name.unique' => 'Tên tài xế đã tồn tại',
            'phone.unique' => 'Số điện thoại đã tồn tại',
            'phone.digits' => 'Số điện thoại không hợp lệ',
            'phone.regex' => 'Số điện thoại không hợp lệ',
            'status.required' => 'trạng thái không tồn tại',
            'status.in' => 'trạng thái không hợp lệ',
        ]
        )&& $driver ){
            $driver->update([
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'status'=> $request->input('status'),
            ]); 
            return redirect()->route('boss.driver.index')->with('alert-success','Cập nhật thành công.');
        }
        else{
            return redirect()->route('boss.driver.index')->with('alert-danger','Cập nhật thất bại, tài xế không tồn tại.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        
    }
}
