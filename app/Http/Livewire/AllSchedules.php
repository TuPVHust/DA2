<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Schedule;
use App\Models\User;
use App\Models\Truck;
use App\Models\Partner;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
        dd($value);
    }
    public function changeTruck($value)
    {
        $this->truckFilter = $value;
        dd($value);
    }
    public function changeCarOwner($value)
    {
        $this->carOwnerFilter = $value;
        dd($value);
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
        $schedules = Schedule::where('date','>=', $this->floorTimeBound)->where('date','<=',$this->ceilingTimeBound)->orderBy($this->orderBy, $this->order)->get();
        //dd($this->ceilingTimeBound);
        return view('livewire.all-schedules',[
            'schedules' => $schedules,
            'car_owners' => $car_owners,
            'trucks' => $trucks,
            'drivers' => $drivers,
        ]);
        
    }
}
