<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\ScheduleDetail;
use App\Models\User;
use App\Models\Truck;
use App\Models\Partner;
use App\Models\Category;
use App\Models\Order;
use App\Models\CostDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function tracking()
    {
        return view('boss.tracking');
    }

    public function dashboard()
    {
        $topCategories_name = array();
        $topCategories_value = array();

        $topCosts_name = array();
        $topCosts_value = array();

        $monthKey = array();
        $revenueForMonth = array();
        $costForMonth = array();
        $actualRevenueForMonth = array();

        $timeInterval = array(1 => 'January',2=>'February',3=>'March',4=>'April',5=>'May',6=>'June',7=>'July',8=>'August',9=>'September',10=>'October',11=>'November',12=>'December');
        $year = Carbon::now()->year;
        //$year = 2020;
        $month = Carbon::now()->month;

        $driver_details = User::join('schedules','users.id','=','schedules.driver_id')->join('schedule_details','schedule_details.schedule_id','=','schedules.id');
        //dd($driver_details->get());
        
        $cost_details = CostDetail::join('schedules','schedules.id','=','cost_details.schedule_id')->join('cost_groups','cost_groups.id','=','cost_details.cost_group_id');
        $category_details = Category::leftJoin('schedule_details','schedule_details.category_id','=','categories.id')->leftJoin('schedules','schedule_details.schedule_id','=','schedules.id')->whereYear('schedules.date', $year);
        $topCategories = $category_details->select('categories.*',DB::raw('count(schedule_details.id) as detailNum'))->groupBy('categories.id')->orderBy('detailNum','desc')->take(5)->get();
        $topCosts = $cost_details->select('cost_groups.*', DB::raw('sum(cost_details.cost)/1000000 as costSum'))->groupBy('cost_groups.id')->orderBy('costSum', 'desc')->take(5)->get();
        $topDrivers = $driver_details->select('users.*',DB::raw('count(schedule_details.id) as detailNum'))->groupBy('users.id')->whereMonth('date', $month)->orderBy('detailNum','desc')->take(4)->get();
        //dd($topCategories);
        foreach($topCategories as $topCategory)
        {
            array_push($topCategories_name,$topCategory->name);
            array_push($topCategories_value,$topCategory->detailNum);
        }

        foreach($topCosts as $topCost)
        {
            array_push($topCosts_name,$topCost->name);
            array_push($topCosts_value,$topCost->costSum);
        }

        foreach($timeInterval as $key => $value)
        {
            $scheduleDetails = ScheduleDetail::leftJoin('schedules','schedule_details.schedule_id','=','schedules.id')->leftJoin('cost_details','cost_details.schedule_id','=','schedules.id')->leftJoin('cost_groups','cost_groups.id','=','cost_details.cost_group_id')->leftJoin('categories','schedule_details.category_id','=','categories.id')->whereMonth('schedules.date', $key)->whereYear('schedules.date', $year);
            $scheduleDetails = $scheduleDetails->get();
            //dd($scheduleDetails->count());
            $revenue = $scheduleDetails->sum('revenue')/1000000;
            $actual_revenue = $scheduleDetails->sum('actual_revenue')/1000000;
            $cost = $scheduleDetails->sum('cost')/1000000;
            array_push($revenueForMonth,$revenue);
            array_push($actualRevenueForMonth,$actual_revenue);
            array_push($costForMonth,$cost);
            array_push($monthKey,$value);
        }
        $js_revenueForMonth_array = json_encode($revenueForMonth);
        $js_actualRevenueForMonth_array = json_encode($actualRevenueForMonth);
        $js_costForMonth_array = json_encode($costForMonth);

        $js_timeInterval_array = json_encode($monthKey,JSON_UNESCAPED_UNICODE);

        $js_topCategories_name_array = json_encode($topCategories_name,JSON_UNESCAPED_UNICODE );

        $js_topCategories_value_array = json_encode($topCategories_value);
        $js_topCategories_name_array = str_replace('"', "'", $js_topCategories_name_array );

        $js_topCosts_name_array = json_encode($topCosts_name,JSON_UNESCAPED_UNICODE );
        $js_topCosts_value_array = json_encode($topCosts_value);
        
        //dd($scheduleDetails->count());
        return view('boss.dashboard',[
            'revenueForMonth' => $js_revenueForMonth_array,
            'actualRevenueForMonth' => $js_actualRevenueForMonth_array,
            'timeInterval' => $js_timeInterval_array,
            'costForMonth' => $js_costForMonth_array,
            'topCategories_name' => $js_topCategories_name_array,
            'topCategories_value' => $js_topCategories_value_array,
            'topCosts_name' => $js_topCosts_name_array,
            'topCosts_value' => $js_topCosts_value_array,
            'thisYear' => $year,
            'topDrivers' => $topDrivers,
        ]);
    }
}
