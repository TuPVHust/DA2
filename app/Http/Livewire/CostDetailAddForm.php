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

class CostDetailAddForm extends Component
{
    public $todayDoingSchedule;
    public $costGroup= null;
    public $cost= null;
    public $actual_cost= null;
    public $costDescription= null;
    public function resetAttribute(){
        $this->costGroup= null;
        $this->cost= null;
        $this->actual_cost= null;
        $this->costDescription= null;
        $this->dispatchBrowserEvent('removeInputValue', []);
        $this->dispatchBrowserEvent('reloadJs', []);
    }
    protected $rules = [
        'cost' => 'required|gt:0',
        'actual_cost' => 'required|gt:0',
        'costGroup' => 'required',
        //'scheDetDescription' => 'required',
        //'email' => 'required|email',
    ];
    public function updated(){
        $this->dispatchBrowserEvent('reloadJs', []);
    }
    protected $listeners = ['addCostDetail','changeCostGroup'];
    public function changeCostGroup($value){
        $this->costGroup = $value;
        //dd($this->activeCost);
        $this->dispatchBrowserEvent('reloadJs', []);
    }
    public function addCostDetail($id){
        $this->dispatchBrowserEvent('reloadJs', []);
        $this->validate();
        $this->emit('handleAddCostDetail', $id, $this->costGroup,$this->cost,$this->actual_cost,$this->costDescription);
        $this->resetAttribute();
    }
    public function render()
    {
        $costGroups = CostGroup::all();
        return view('livewire.cost-detail-add-form',[
            'costGroups' => $costGroups
        ]);
    }
}
