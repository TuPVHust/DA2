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
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $orderBy = 'date';
    public $order = 'desc';
    public $searchKey = null;
    public $driverFilter = null;
    public $truckFilter = null;
    public $carOwnerFilter = null;
    public $orderFilter = null;
    public $buyerFilter = null;
    public $sellerFilter = null;
    public $categoryFilter = null;
    public $floorTimeBound;
    public $ceilingTimeBound;
    public $timeRange;
    public $itemsPerPage = 5;
    public $updateNum = 1;
    public $hiddenColums = array('Ngày'=>false,'Xe'=>false,'Chủ xe'=>false,'Tài xế'=>false,'Ca'=>false,'Hàng'=>false,'Mua'=>false,'Bán'=>false,'Giá mua'=>false,'Giá bán'=>false,'Thực chi'=>false,'Thực thu'=>false,'Đơn hàng'=>true,'K.lượng'=>false,'Mô tả'=>true,'Hành động'=>false);

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
    public function changeCategory($value)
    {
        $this->categoryFilter = $value;
        //dd($value);
    }
    public function changeSeller($value)
    {
        $this->sellerFilter = $value;
        //dd($value);
    }
    public function changeBuyer($value)
    {
        $this->buyerFilter = $value;
        //dd($value);
    }
    public function changeOrder1($value)
    {
        $this->orderFilter = $value;
        //dd($value);
    }
    protected $listeners = ['ChangeTimeRange','changeOrderBy','changeOrder','changeDriver','changeTruck','changeCarOwner','ChangeHiddenColums','changeCategory','changeSeller','changeBuyer','changeOrder1','refresh_me' => '$refresh',];
    public function mount() {
        $this->floorTimeBound=Schedule::min('date');
        $this->ceilingTimeBound=Schedule::max('date');
        $this->timeRange = Carbon::parse($this->floorTimeBound)->format('d/m/Y') . " - " . Carbon::parse($this->ceilingTimeBound)->format('d/m/Y');
    }
    public function update()
    {
        //$this->dispatchBrowserEvent('contentChanged');
        //$this->emit('contentChanged');
        $this->updateNum++;
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
        if($this->searchKey != null){
            $schedule_details =  ScheduleDetail::join('schedules','schedule_details.schedule_id','=','schedules.id')->join('trucks','schedules.truck_id','=','trucks.id')->join('users','schedules.driver_id','=','users.id')->join('partners','schedules.car_owner_id','=','partners.id')->join('categories','schedule_details.category_id','=','categories.id')->join('orders','schedule_details.order_id','=','orders.id')->select('schedule_details.*',DB::raw('schedule_details.price - schedule_details.actual_price  as sellerLoan'),DB::raw('schedule_details.revenue - schedule_details.actual_revenue as buyerLoan'),'users.name as driverName','partners.name as carOwnerName','trucks.plate as truckPlate')->where('users.name' ,'LIKE','%'.$this->searchKey.'%')->orWhere('partners.name' ,'LIKE','%'.$this->searchKey.'%')->orWhere('trucks.plate' ,'LIKE','%'.$this->searchKey.'%')->orWhere('schedules.description' ,'LIKE','%'.$this->searchKey.'%')->orWhere('schedule_details.description' ,'LIKE','%'.$this->searchKey.'%')->orWhere('categories.name' ,'LIKE','%'.$this->searchKey.'%')->orWhere('orders.summary' ,'LIKE','%'.$this->searchKey.'%')->where('date','>=', $this->floorTimeBound)->where('date','<=',$this->ceilingTimeBound)->orderBy($this->orderBy, $this->order);
        }
        else{
            $schedule_details =  ScheduleDetail::join('schedules','schedule_details.schedule_id','=','schedules.id')->join('trucks','schedules.truck_id','=','trucks.id')->join('users','schedules.driver_id','=','users.id')->join('partners','schedules.car_owner_id','=','partners.id')->join('categories','schedule_details.category_id','=','categories.id')->leftJoin('orders','schedule_details.order_id','=','orders.id')->select('schedule_details.*',DB::raw('schedule_details.price - schedule_details.actual_price  as sellerLoan'),DB::raw('schedule_details.revenue - schedule_details.actual_revenue as buyerLoan'),'users.name as driverName','partners.name as carOwnerName','trucks.plate as truckPlate')->where('date','>=', $this->floorTimeBound)->where('date','<=',$this->ceilingTimeBound)->orderBy($this->orderBy, $this->order);
        }
        if($this->driverFilter != null)
        {
            $schedule_details = $schedule_details->where('driver_id',$this->driverFilter);
        }
        if($this->truckFilter != null)
        {
            $schedule_details = $schedule_details->where('truck_id',$this->truckFilter);
        }
        if($this->carOwnerFilter != null)
        {
            $schedule_details = $schedule_details->where('car_owner_id',$this->carOwnerFilter);
        }
        if($this->categoryFilter != null)
        {
            $schedule_details = $schedule_details->where('categories.id',$this->categoryFilter);
        }
        if($this->sellerFilter != null)
        {
            $schedule_details = $schedule_details->where('seller_id',$this->sellerFilter);
        }
        if($this->buyerFilter != null)
        {
            $schedule_details = $schedule_details->where('buyer_id',$this->buyerFilter);
        }
        if($this->orderFilter != null)
        {
            if($this->orderFilter != 'none'){
                $schedule_details = $schedule_details->where('orders.id',$this->orderFilter);
            }
            else{
                $schedule_details = $schedule_details->where('orders.id',null);
            }
        }
        //$this->dispatchBrowserEvent('contentChanged');
        
        $schedule_details= $schedule_details->paginate($this->itemsPerPage);
        $countShowing = $schedule_details->count();
        $total = $schedule_details->total();
        $this->resetPage();
        $this->emit('contentChanged');
        return view('livewire.all-schedule-detail',[
            'schedule_details' => $schedule_details,
            'car_owners' => $car_owners,
            'trucks' => $trucks,
            'drivers' => $drivers,
            'categories' => $categories,
            'buyers' => $buyers,
            'sellers' => $sellers,
            'orders' => $orders,
            'countShowing' => $countShowing,
            'total' => $total,
        ]);
    }
}
