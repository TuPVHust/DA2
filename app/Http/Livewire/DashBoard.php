<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Schedule;
use App\Models\ScheduleDetail;
use App\Models\User;
use App\Models\Truck;
use App\Models\Partner;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Stevebauman\Location\Facades\Location;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class DashBoard extends Component
{
    public $thisYear;
    public $topDrivers;
    public function render()
    {
        // $ip = '14.177.188.58';
        // $currentUserInfo = Location::get($ip);
        // dd($currentUserInfo);
        return view('livewire.dash-board');
    }
}
