<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Schedule;
use App\Models\User;
use App\Models\Truck;
use App\Models\Category;
use App\Models\CostGroup;
use App\Models\CostDetail;
use App\Models\ScheduleDetail;
use App\Models\Order;
use App\Models\Partner;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Notifications\completeSchedule;
class StaffWorks extends Component
{
    public $editingScheDetail = null;
    public $editingCostDetail = null;
    public $activeCost = false;
    public $showAddForm = false;
    public $buyer= null;
    public $seller= null;
    public $order= null;
    public $category= null;
    public $price= null;
    public $actual_price= null;
    public $revenue= null;
    public $actual_revenue= null;
    public $quantity= null;
    public $distance= null;
    public $scheDetDescription= null;
    public function resetAttribute(){
        $this->distance = null;
        $this->buyer= null;
        $this->seller= null;
        $this->order= null;
        $this->category= null;
        $this->price= null;
        $this->actual_price= null;
        $this->revenue= null;
        $this->actual_revenue= null;
        $this->quantity= null;
        $this->scheDetDescription= null;
        $this->costGroup= null;
        $this->cost= null;
        $this->actual_cost= null;
        $this->costDescription= null;
        $this->dispatchBrowserEvent('removeInputValue', []);
        $this->dispatchBrowserEvent('reloadJs', []);
    }
    //public $tester=null;
    protected $rules = [
        'buyer' => 'required',
        'seller' => 'required',
        'order' => 'required',
        'category' => 'required',
        'price' => 'required|gt:0',
        'actual_price' => 'required|gt:0',
        'revenue' => 'required|gt:0',
        'actual_revenue' => 'required|gt:0',
        'quantity' => 'required|gt:0',
        'distance' => 'required|gt:0',
        //'scheDetDescription' => 'required',
        //'email' => 'required|email',
    ];
    protected $listeners = ['completeWork','addScheduleDetail','handleAddCostDetail','changeOrder','changeBuyer','changeSeller','changeCategory','toggleAddForm','changeTab','deleteScheDetail','deleteCostDetail','editScheduleDetail','updateSchedulesDetail','cancelEdit','closeInforModal','editCostDeatail','updateCostDetail','newNotificationCreated'];
    public function newNotificationCreated(){
        //dd('oki');
    }
    public function handleEditCostDetail(){
        //dd('oki');
        $validateData = Validator::make($this->editingCostDetail, [
            'cost' => 'required|gt:0',
            'actual_cost' => 'required|gt:0',
            'cost_group_id' => 'required'
        ])->validate();
        $costDetail = CostDetail::where('id', $this->editingCostDetail['id']);
        if($costDetail){
            $costDetail->update([
                'description' => $this->editingCostDetail['description'],
                'cost' => $this->editingCostDetail['cost'],
                'actual_cost' => $this->editingCostDetail['actual_cost'],
                'cost_group_id' => $this->editingCostDetail['cost_group_id']
            ]);
            $this->dispatchBrowserEvent('closeEdititngModal', []);
            session()->flash('alert-success', 'Cập nhật thành công !!!');
            $this->editingCostDetail = null;
        }
        else{
            session()->flash('alert-danger', 'Cập nhật thất bại, thử tải lại trang và thử lại !!!');
            $this->editingCostDetail = null;
        }
        
    }
    public function editCostDeatail($value){
        //dd($value);
        $this->editingCostDetail = $value;
        //dd($this->editingScheDetail);
        $this->dispatchBrowserEvent('showCostDetailEditForm', []);
        //$this->showAddForm = false;
        $this->dispatchBrowserEvent('reloadJs', []);   
    }

    public function closeInforModal(){
        //dd('oki');
        $this->resetAttribute();
        $this->dispatchBrowserEvent('removeInputValue', []);
        //Session::flush('errors');
    }

    public function cancelEdit(){
        $this->editingScheDetail = null;
    }
    public function updateSchedulesDetail($value,$key)
    {
        //dd($key, $value);
        $this->editingScheDetail[$key] = $value;
        $this->dispatchBrowserEvent('reloadJs', []);
    }
    public function updateCostDetail($value,$key)
    {
        //dd($key, $value);
        $this->editingCostDetail[$key] = $value;
        $this->dispatchBrowserEvent('reloadJs', []);
    }

    public function editScheduleDetail()
    {
        $validateData = Validator::make($this->editingScheDetail, [
            'buyer_id' => 'required',
            'seller_id' => 'required',
            'category_id' => 'required',
            'price' => 'required|gt:0',
            'actual_price' => 'required|gt:0',
            'revenue' => 'required|gt:0',
            'actual_revenue' => 'required|gt:0',
            'quantity' => 'required|gt:0',
            'distance' => 'required|gt:0',
        ])->validate();
        $editingScheDetail = ScheduleDetail::where('id',$this->editingScheDetail['id']);
        if($editingScheDetail){
            if($this->order !== 'none'&& $this->order !== null){
                $editingScheDetail->update([
                    'description' => $this->editingScheDetail['description'],
                    'seller_id' => $this->editingScheDetail['seller_id'],
                    'buyer_id' => $this->editingScheDetail['buyer_id'],
                    'order_id' => $this->editingScheDetail['order_id'],
                    'category_id' => $this->editingScheDetail['category_id'],
                    'price' => $this->editingScheDetail['price'],
                    'actual_price' => $this->editingScheDetail['actual_price'],
                    'revenue' => $this->editingScheDetail['revenue'],
                    'actual_revenue' => $this->editingScheDetail['actual_revenue'],
                    'quantity' => $this->editingScheDetail['quantity'],
                    'distance' => $this->editingScheDetail['distance'],
                ]);
            }
            else{
                $editingScheDetail->update([
                    'description' => $this->editingScheDetail['description'],
                    'seller_id' => $this->editingScheDetail['seller_id'],
                    'buyer_id' => $this->editingScheDetail['buyer_id'],
                    'order_id' => null,
                    'category_id' => $this->editingScheDetail['category_id'],
                    'price' => $this->editingScheDetail['price'],
                    'actual_price' => $this->editingScheDetail['actual_price'],
                    'revenue' => $this->editingScheDetail['revenue'],
                    'actual_revenue' => $this->editingScheDetail['actual_revenue'],
                    'quantity' => $this->editingScheDetail['quantity'],
                    'distance' => $this->editingScheDetail['distance'],
                ]);
            }
            $this->editingScheDetail = null;
            $this->dispatchBrowserEvent('closeEdititngModal', []);
            session()->flash('alert-success', 'Cập nhật thành công !!!');  
        }
        else{
            session()->flash('alert-edit', 'Có lỗi khi cập nhật !!!');
            $this->dispatchBrowserEvent('closeEdititngModal', []);
            $this->editingScheDetail = null;
        }
        
    } 
    public function editScheDeatail($value){
        //dd($value);
        $this->editingScheDetail = $value;
        //dd($this->editingScheDetail);
        $this->dispatchBrowserEvent('showScheDetailEditForm', []);
        //$this->showAddForm = false;
        $this->dispatchBrowserEvent('reloadJs', []);   
    }
    public function deleteCostDetail($id){
        $cost_detail = CostDetail::find($id);
        if($cost_detail){
            if($cost_detail->schedule->status == 1 && $cost_detail->schedule->driver->id == Auth::user()->id)
            {
                $cost_detail->delete();
            }
        }
        $this->dispatchBrowserEvent('reloadJs', []);
        session()->flash('alert-success', 'Xóa bản ghi thành công !!!');
    }
    public function deleteScheDetail($id){
        $schedule_detail = ScheduleDetail::find($id);
        if($schedule_detail){
            if($schedule_detail->schedule->status == 1 && $schedule_detail->schedule->driver->id == Auth::user()->id)
            {
                $schedule_detail->delete();
            }
        }
        $this->dispatchBrowserEvent('reloadJs', []);
        session()->flash('alert-success', 'Xóa bản ghi thành công !!!');
    }
    public function changeTab(){
        $this->activeCost = !$this->activeCost;
        //dd($this->activeCost);
        $this->dispatchBrowserEvent('reloadJs', []);
    }
    public function toggleAddForm(){
        $this->showAddForm = !$this->showAddForm;
        $this->dispatchBrowserEvent('reloadJs', []);
    }
    
    public function changeBuyer($value)
    {
        $this->buyer = $value;
        //dd($value);
        $this->dispatchBrowserEvent('reloadJs', []);
    }
    public function changeSeller($value)
    {
        $this->seller = $value;
        //dd($value);
        $this->dispatchBrowserEvent('reloadJs', []);
    }
    public function changeCategory($value)
    {
        $this->category = $value;
        //dd($value);
        $this->dispatchBrowserEvent('reloadJs', []);
    }
    public function changeOrder($value)
    {
        $this->order = $value;
        //dd($value);
        $this->dispatchBrowserEvent('reloadJs', []);
    }
    public function updated(){
        $this->dispatchBrowserEvent('reloadJs', []);
    }
    public function addScheduleDetail($id){
        $this->dispatchBrowserEvent('reloadJs', []);
        $this->validate();
        //dd('oki');
        if($this->order !== 'none'){
            $schedule_detail = ScheduleDetail::create([
                'description' => $this->scheDetDescription,
                'seller_id' => $this->seller,
                'buyer_id' => $this->buyer,
                'order_id' => $this->order,
                'category_id' => $this->category,
                'price' => $this->price,
                'actual_price' => $this->actual_price,
                'revenue' => $this->revenue,
                'actual_revenue' => $this->actual_revenue,
                'quantity' => $this->quantity,
                'distance' => $this->distance,
                'schedule_id' => $id,
            ]);
        }
        else{
            $schedule_detail = ScheduleDetail::create([
                'description' => $this->scheDetDescription,
                'seller_id' => $this->seller,
                'buyer_id' => $this->buyer,
                'order_id' => null,
                'category_id' => $this->category,
                'price' => $this->price,
                'actual_price' => $this->actual_price,
                'revenue' => $this->revenue,
                'actual_revenue' => $this->actual_revenue,
                'quantity' => $this->quantity,
                'distance' => $this->distance,
                'schedule_id' => $id,
            ]);
        }
        $this->resetAttribute();
        session()->flash('alert-success', 'Thêm mới thành công !!!');
    }
    public function handleAddCostDetail($id, $costGroup, $cost, $actual_cost,$costDescription){
        $this->dispatchBrowserEvent('reloadJs', []);
        $CostDetail = CostDetail::create([
            'description' => $costDescription,
            'cost' => $cost,
            'actual_cost' => $actual_cost,
            'schedule_id' => $id,
            'cost_group_id' => $costGroup
        ]);
        $this->resetAttribute();
        session()->flash('alert-success', 'Thêm mới thành công !!!');
    }

    public function completeWork($id){
        //abort(403);
        
        $user = Auth::user();
        $schedule = Schedule::find($id);
        //dd($schedule);
        if($schedule !=null && $user != null && $schedule->driver_id == $user->id && $schedule->status == 1)
        {
            $schedule->update([
                'status' => 0,
            ]);
            $admins = User::where('role',1)->get();
            \Notification::send($admins, new completeSchedule(Auth::user(), $schedule));
            //dd($id);
        }
        else{
            abort(403);
        }
    }
    public function render()
    {
        //$this->dispatchBrowserEvent('showScheDetailEditForm', []);
        $schedules = Schedule::orderBy('date','desc')->get();
        $categories = Category::all();
        $sellers = Partner::where('NCC',1)->get();
        $buyers = Partner::where('NM',1)->get();
        $orders = Order::all();
        $costGroups = CostGroup::all();
        
        $todayDoingSchedules = Schedule::where('date', Carbon::today('Asia/Bangkok'))->where('status',1)->where('driver_id',Auth::user()->id)->orderBy('id','desc')->get();
        $todayCompltedSchedules = Schedule::where('date', Carbon::today('Asia/Bangkok'))->where('status',0)->where('driver_id',Auth::user()->id)->orderBy('id','desc')->get();
        $inQueueSchedules = Schedule::where('date','!=',Carbon::today('Asia/Bangkok'))->where('status',1)->where('driver_id',Auth::user()->id)->orderBy('id','desc')->get();
        //dd($todayDoingSchedules->count());
        return view('livewire.staff-works',[
            'todayDoingSchedules' => $todayDoingSchedules,
            'todayCompltedSchedules' => $todayCompltedSchedules,
            'inQueueSchedules' => $inQueueSchedules,
            'schedules' => $schedules,
            'categories' => $categories,
            'sellers' => $sellers,
            'buyers' => $buyers,
            'orders' => $orders,
            'costGroups' => $costGroups
            //'tester' => $this->tester,
        ]);
    }
}
