<?php

namespace App\Http\Livewire;
use Livewire\Component;
use App\Models\Schedule;
use App\Models\ScheduleDetail;
use App\Models\User;
use App\Models\Truck;
use App\Models\Partner;
use App\Models\CostGroup;
use App\Models\CostDetail;
use App\Models\Order;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class AllCostDetails extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $orderBy = 'date';
    public $order = 'desc';
    public $searchKey = null;
    public $driverFilter = null;
    public $truckFilter = null;
    public $carOwnerFilter = null;
    public $costGroupFilter = null;
    public $floorTimeBound;
    public $ceilingTimeBound;
    public $timeRange;
    public $itemsPerPage = 5;
    public $updateNum = 1;
    public $hiddenColums = array('Ngày'=>false,'Xe'=>false,'Chủ xe'=>false,'Tài xế'=>false,'Ca'=>false,'Loại'=>false,'Giá'=>false,'Thực chi'=>false,'Mô tả'=>true,'Hành động'=>false);

    public function ChangeTimeRange($value)
    {
        if((bool)strtotime(str_replace('/', '-', explode( ' - ', $value )[0])) && (bool)strtotime(str_replace('/', '-', explode( ' - ', $value )[0])))
        {
            if(Schedule::all()->count()>0)
            {
                $this->floorTimeBound = date('Y-m-d',strtotime(str_replace('/', '-', explode( ' - ', $value )[0])));
                $this->ceilingTimeBound = date('Y-m-d',strtotime(str_replace('/', '-', explode( ' - ', $value )[1])));
                $this->timeRange = Carbon::parse($this->floorTimeBound)->format('d/m/Y') . " - " . Carbon::parse($this->ceilingTimeBound)->format('d/m/Y');
            }
        }
        else{
            session()->flash('alert-date', 'Khong dung dinh dang ngay !!!');
        }
        // $this->dispatchBrowserEvent('contentChanged');
        //dd($this->ceilingTimeBound);
    }
    public function ChangeHiddenColums($array)
    {
        if(count($array)==0)
        {
            foreach($this->hiddenColums as $key2=>$value2)
            {
                $this->hiddenColums[$key2] = false;
            }
        }
        else{
            foreach($this->hiddenColums as $key1 => $value1)
            {
                foreach($array as $key2=>$value2)
                {
                    if($value2 == $key1)
                    {
                        $this->hiddenColums[$key1] = true;
                    }
                    else
                    {
                        if(!in_array($key1, $array))
                        {
                            $this->hiddenColums[$key1] = false;
                        }
                    }
                }
            }
        }
        $this->emitself('refresh_me');
    }
    public function changeOrderBy($value)
    {
        $this->orderBy = $value;
        //$this->dispatchBrowserEvent('contentChanged');
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
    public function changeCostGroup($value)
    {
        $this->costGroupFilter = $value;
        //dd($value);
    }
    protected $listeners = ['ChangeTimeRange','changeOrderBy','changeOrder','changeDriver','changeTruck','changeCarOwner','ChangeHiddenColums','changeCostGroup','refresh_me' => '$refresh',];
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
    public function update()
    {
        //$this->dispatchBrowserEvent('contentChanged');
        //$this->emit('contentChanged');
        //$this->updateNum++;
    }

    public function render()
    {
        
        $trucks = Truck::where('status',1)->get();
        $costGroups = CostGroup::all();
        //$orders = Order::where('status',1)->get();
        $drivers = User::where('role', 0)->where('status', 1)->get();
        $car_owners = Partner::where('car_owner', 1)->get();
        //$buyers = Partner::where('NM', 1)->get();
        //$sellers = Partner::where('NCC', 1)->get();
        if($this->searchKey != null){
            $cost_details =  CostDetail::join('schedules','cost_details.schedule_id','=','schedules.id')->join('trucks','schedules.truck_id','=','trucks.id')->join('users','schedules.driver_id','=','users.id')->join('partners','schedules.car_owner_id','=','partners.id')->join('cost_groups','cost_groups.id','=','cost_details.cost_group_id')->select('cost_details.*','users.name as driverName','partners.name as carOwnerName','trucks.plate as truckPlate')->where('users.name' ,'LIKE','%'.$this->searchKey.'%')->orWhere('partners.name' ,'LIKE','%'.$this->searchKey.'%')->orWhere('trucks.plate' ,'LIKE','%'.$this->searchKey.'%')->orWhere('schedules.description' ,'LIKE','%'.$this->searchKey.'%')->orWhere('cost_details.description' ,'LIKE','%'.$this->searchKey.'%')->orWhere('cost_groups.name' ,'LIKE','%'.$this->searchKey.'%')->where('date','>=', $this->floorTimeBound)->where('date','<=',$this->ceilingTimeBound)->orderBy($this->orderBy, $this->order);
        }
        else{
            $cost_details =  CostDetail::join('schedules','cost_details.schedule_id','=','schedules.id')->join('trucks','schedules.truck_id','=','trucks.id')->join('users','schedules.driver_id','=','users.id')->join('partners','schedules.car_owner_id','=','partners.id')->join('cost_groups','cost_groups.id','=','cost_details.cost_group_id')->select('cost_details.*','users.name as driverName','partners.name as carOwnerName','trucks.plate as truckPlate')->where('date','>=', $this->floorTimeBound)->where('date','<=',$this->ceilingTimeBound)->orderBy($this->orderBy, $this->order);
        }
        if($this->driverFilter != null)
        {
            $cost_details = $cost_details->where('driver_id',$this->driverFilter);
        }
        if($this->truckFilter != null)
        {
            $cost_details = $cost_details->where('truck_id',$this->truckFilter);
        }
        if($this->carOwnerFilter != null)
        {
            $cost_details = $cost_details->where('car_owner_id',$this->carOwnerFilter);
        }
        if($this->costGroupFilter != null)
        {
            $cost_details = $cost_details->where('cost_groups.id',$this->costGroupFilter);
        }
        //$this->dispatchBrowserEvent('contentChanged');
        $sum_cost = $cost_details->sum('cost')/1000000;
        $sum_actual_cost = $cost_details->sum('actual_cost')/1000000;

        if($this->itemsPerPage < 0)
        {
            $this->itemsPerPage =null;
        }
        $this->itemsPerPage =(int)$this->itemsPerPage;
        $cost_details= $cost_details->paginate((int)$this->itemsPerPage);
        $countShowing = $cost_details->count();
        $total = $cost_details->total();
        $this->resetPage();
        $this->updateNum++;
        $this->emit('contentChanged', [$this->updateNum]);
        return view('livewire.all-cost-details',[
            'cost_details' => $cost_details,
            'car_owners' => $car_owners,
            'trucks' => $trucks,
            'drivers' => $drivers,
            'costGroups' => $costGroups,
            'countShowing' => $countShowing,
            'total' => $total,
            'sum_cost' => $sum_cost,
            'sum_actual_cost' => $sum_actual_cost,
        ]);
    }
}
