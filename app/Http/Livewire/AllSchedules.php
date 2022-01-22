<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Schedule;
use App\Models\User;
use App\Models\Truck;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AllSchedules extends Component
{
    public function render()
    {
        $schedules = Schedule::all();
        return view('livewire.all-schedules',[
            'schedules' => $schedules,
        ]);
    }
}
