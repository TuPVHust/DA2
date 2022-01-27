<?php

namespace App\Http\Controllers;

use App\Models\ScheduleDetail;
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
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
