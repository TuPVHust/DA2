<?php

namespace App\Http\Livewire;

use Livewire\Component;
Use App\Events\TruckMoved;
use Illuminate\Support\Facades\Auth;
class BroadcastPosition extends Component
{
    protected $listeners = [
        'positionBroadCastes',
    ];
    public function positionBroadCastes($latitude, $longitude, $speed, $timeStamp)
    {
        //dd(Auth::user()->name);
        //dd($timeStamp);
        event(new TruckMoved($latitude, $longitude, $speed, $timeStamp, Auth::user()->id));
    }
    public function render()
    {
        return view('livewire.broadcast-position');
    }
}
