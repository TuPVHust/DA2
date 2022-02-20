<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Schedule;
use App\Models\User;
use App\Models\Truck;
use App\Models\Partner;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class AllSchedules extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
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
    public $itemsPerPage = 5;

    public function mount() {
        $this->floorTimeBound = Carbon::now();
        $this->ceilingTimeBound= Carbon::now();
        if(Schedule::all()->count()>0)
        {
            $this->floorTimeBound=Schedule::min('date');
            $this->ceilingTimeBound=Schedule::max('date');
        }
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
        // $this->dispatchBrowserEvent('contentChanged');
    }

    public function render()
    {
        // dd($this->timeRange);
        $trucks = Truck::all();
        $drivers = User::where('role', 0)->get();
        $car_owners = Partner::where('car_owner', 1)->get();
        
        
        if($this->searchKey != null)
        {
            $schedules = Schedule::leftJoin('schedule_details','schedule_details.schedule_id','=','schedules.id')->leftJoin('users','schedules.driver_id','=','users.id')->leftJoin('trucks','schedules.truck_id','=','trucks.id')->leftJoin('partners','schedules.car_owner_id','=','partners.id')->where('users.name' ,'LIKE','%'.$this->searchKey.'%')->orWhere('partners.name' ,'LIKE','%'.$this->searchKey.'%')->orWhere('trucks.plate' ,'LIKE','%'.$this->searchKey.'%')->orWhere('schedules.description' ,'LIKE','%'.$this->searchKey.'%')->select('schedules.id as schedule_id',DB::raw('count(schedule_details.id) as detailNum'),'schedules.*','users.name as driverName','partners.name as carOwnerName','trucks.plate as truckPlate')->groupBy('schedules.id')->where('date','>=', $this->floorTimeBound)->where('date','<=',$this->ceilingTimeBound)->orderBy($this->orderBy, $this->order);   
        }
        else{
            $schedules = Schedule::leftJoin('schedule_details','schedule_details.schedule_id','=','schedules.id')->leftJoin('users','schedules.driver_id','=','users.id')->leftJoin('trucks','schedules.truck_id','=','trucks.id')->leftJoin('partners','schedules.car_owner_id','=','partners.id')->select('schedules.id as schedule_id',DB::raw('count(schedule_details.id) as detailNum'),'schedules.*','users.name as driverName','partners.name as carOwnerName','trucks.plate as truckPlate')->groupBy('schedules.id')->where('date','>=', $this->floorTimeBound)->where('date','<=',$this->ceilingTimeBound)->orderBy($this->orderBy, $this->order);
        }
        
        if($this->driverFilter != null)
        {
            //dd($schedules);
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
        if($this->detailNumFilter != null)
        {
            //dd($schedules);
            if($schedules->get()->where('detailNum',$this->detailNumFilter)->count()>0)
            {
                $schedules = $schedules->get()->where('detailNum',$this->detailNumFilter);
                $schedules = $schedules->toQuery();
            }
            else{
                $schedules = $schedules->whereNull('schedules.id');
            }
        }
        //dd($schedules->get()->where('detailNum',2));
        $schedules= $schedules->paginate($this->itemsPerPage);
        
        //dd($schedules);
        $this->resetPage();
        // dd($schedules);
        return view('livewire.all-schedules',[
            'schedules' => $schedules,
            'car_owners' => $car_owners,
            'trucks' => $trucks,
            'drivers' => $drivers,
        ]);
    }
}
