<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Schedule;
use App\Models\User;
use App\Models\Truck;
use App\Models\Partner;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AllSchedules extends Component
{
    
    public $orderBy = 'date';
    public $order = 'desc';
    public $searchKey = null;
    public $driverFilter = null;
    public $truckFilter = null;
    public $carOwnerFilter = null;
    public $detailNumFilter = null;
    public $floorTimeBound;
    public $ceilingTimeBound;
    public $timeRange;

    public function mount() {
        $this->floorTimeBound=Schedule::min('date');
        $this->ceilingTimeBound=Schedule::max('date');
        $this->timeRange = Carbon::parse($this->floorTimeBound)->format('d/m/Y') . " - " . Carbon::parse($this->ceilingTimeBound)->format('d/m/Y');
    }

    protected $listeners = ['ChangeTimeRange','changeOrderBy','changeOrder','changeDriver','changeTruck','changeCarOwner',];

    public function changeOrderBy($value)
    {
        $this->orderBy = $value;
    }
    public function changeOrder($value)
    {
        $this->order = $value;
    }
    public function changeDriver($value)
    {
        $this->driverFilter = $value;
        //dd($value);
    }
    public function changeTruck($value)
    {
        $this->truckFilter = $value;
        //dd($value);
    }
    public function changeCarOwner($value)
    {
        $this->carOwnerFilter = $value;
        //dd($value);
    }

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
    }

    public function render()
    {
        // dd($this->timeRange);
        $trucks = Truck::all();
        $drivers = User::where('role', 0)->get();
        $car_owners = Partner::where('car_owner', 1)->get();
        
        
        if($this->searchKey != null)
        {
            $schedules = Schedule::leftJoin('schedule_details','schedule_details.schedule_id','=','schedules.id')->leftJoin('users','schedules.driver_id','=','users.id')->leftJoin('trucks','schedules.truck_id','=','trucks.id')->leftJoin('partners','schedules.car_owner_id','=','partners.id')->where('users.name' ,'LIKE','%'.$this->searchKey.'%')->orWhere('partners.name' ,'LIKE','%'.$this->searchKey.'%')->orWhere('trucks.plate' ,'LIKE','%'.$this->searchKey.'%')->select('schedules.id as id',DB::raw('count(schedule_details.id) as detailNum'),'trucks.id as truck_id','schedules.*','users.name as driverName','partners.id as car_owner_id','users.id as driver_id','trucks.id as truck_id','partners.name as carOwnerName','trucks.plate as truckPlate')->groupBy('schedules.id')->where('date','>=', $this->floorTimeBound)->where('date','<=',$this->ceilingTimeBound)->orderBy($this->orderBy, $this->order)->get();   
        }
        else{
            $schedules = Schedule::leftJoin('schedule_details','schedule_details.schedule_id','=','schedules.id')->leftJoin('users','schedules.driver_id','=','users.id')->leftJoin('trucks','schedules.truck_id','=','trucks.id')->leftJoin('partners','schedules.car_owner_id','=','partners.id')->select('schedules.id as id',DB::raw('count(schedule_details.id) as detailNum'),'trucks.id as truck_id','schedules.*','users.name as driverName','partners.id as car_owner_id','users.id as driver_id','trucks.id as truck_id','partners.name as carOwnerName','trucks.plate as truckPlate')->groupBy('schedules.id')->where('date','>=', $this->floorTimeBound)->where('date','<=',$this->ceilingTimeBound)->orderBy($this->orderBy, $this->order)->get();
        }
        if($this->detailNumFilter != null)
        {
            $schedules = $schedules->where('detailNum',$this->detailNumFilter);
        }
        if($this->driverFilter != null)
        {
            $schedules = $schedules->where('driver_id',$this->driverFilter);
        }
        if($this->truckFilter != null)
        {
            $schedules = $schedules->where('truck_id',$this->truckFilter);
        }
        if($this->carOwnerFilter != null)
        {
            $schedules = $schedules->where('car_owner_id',$this->carOwnerFilter);
        }
        
        
        //dd($this->ceilingTimeBound);
        
        
        // dd($schedules);
        return view('livewire.all-schedules',[
            'schedules' => $schedules,
            'car_owners' => $car_owners,
            'trucks' => $trucks,
            'drivers' => $drivers,
        ]);
        
    }
}
