<?php

namespace App\Http\Controllers;

use App\Models\CostGroup;
use Illuminate\Http\Request;

class CostGroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $costGroups = CostGroup::all();
        return view('boss.cost_group.index',[
            'costGroups' => $costGroups,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('boss.cost_group.create');
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
            'name'=>'required|unique:cost_groups,name',
        ],
        [
            'name.required' => 'Cần nhập tên chi phí',
            'name.unique' => 'Tên chi phí đã tồn tại',
        ]
        )){
            $costGroup = CostGroup::create([
                'name' => $request->input('name'),
            ]); 
            return redirect()->route('boss.cost_group.index')->with('alert-success','Thêm mới thành công.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CostGroup  $costGroup
     * @return \Illuminate\Http\Response
     */
    public function show(CostGroup $costGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CostGroup  $costGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(CostGroup $costGroup)
    {
        return view('boss.cost_group.edit',[
            'costGroup' => $costGroup,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CostGroup  $costGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CostGroup $costGroup)
    {
        if($request->validate([
            'name'=>'required|unique:cost_groups,name,' . $costGroup->id, 
        ],
        [
            'name.required' => 'Cần nhập tên chi phí',
            'name.unique' => 'Tên chi phí đã tồn tại',
        ]
        )){
            $costGroup->update([
                'name' => $request->input('name'),
            ]); 
            return redirect()->route('boss.cost_group.index')->with('alert-success','Cập nhật thành công.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CostGroup  $costGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(CostGroup $costGroup)
    {
        $costGroup->delete();
        return redirect()->route('boss.cost_group.index')->with('alert-success','Xóa bản ghi thành công.');
    }
}
