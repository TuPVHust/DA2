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
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class AllScheduleDetail extends Component
{
    public $orderBy = 'date';
    public $order = 'desc';
    public $searchKey = null;
    public $driverFilter = null;
    public $truckFilter = null;
    public $carOwnerFilter = null;
    public $floorTimeBound;
    public $ceilingTimeBound;
    public $timeRange;

    public function ChangeTimeRange($value)
    {

        if((bool)strtotime(str_replace('/', '-', explode( ' - ', $value )[0])) && (bool)strtotime(str_replace('/', '-', explode( ' - ', $value )[0])))
        {
            $this->floorTimeBound = date('Y-m-d',strtotime(str_replace('/', '-', explode( ' - ', $value )[0])));
            $this->ceilingTimeBound = date('Y-m-d',strtotime(str_replace('/', '-', explode( ' - ', $value )[1])));
            $this->timeRange = Carbon::parse($this->floorTimeBound)->format('d/m/Y') . " - " . Carbon::parse($this->ceilingTimeBound)->format('d/m/Y');
            
        }
        else{
            session()->flash('alert-date', 'Khong dung dinh dang ngay !!!');
        }
        // $this->dispatchBrowserEvent('contentChanged');
        //dd($this->ceilingTimeBound);
    }
    protected $listeners = ['ChangeTimeRange','changeOrderBy','changeOrder','changeDriver','changeTruck','changeCarOwner',];
    public function mount() {
        $this->floorTimeBound=Schedule::min('date');
        $this->ceilingTimeBound=Schedule::max('date');
        $this->timeRange = Carbon::parse($this->floorTimeBound)->format('d/m/Y') . " - " . Carbon::parse($this->ceilingTimeBound)->format('d/m/Y');
    }

    public function render()
    {
        $trucks = Truck::all();
        $categories = Category::all();
        $orders = Order::all();
        $drivers = User::where('role', 0)->get();
        $car_owners = Partner::where('car_owner', 1)->get();
        $buyers = Partner::where('NM', 1)->get();
        $sellers = Partner::where('NCC', 1)->get();
        $schedule_details =  ScheduleDetail::all();
        return view('livewire.all-schedule-detail',[
            'schedule_details' => $schedule_details,
            'car_owners' => $car_owners,
            'trucks' => $trucks,
            'drivers' => $drivers,
            'categories' => $categories,
            'buyers' => $buyers,
            'sellers' => $sellers,
            'orders' => $orders,
        ]);
    }
}
