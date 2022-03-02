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
    public function positionBroadCastes($latitude, $longitude, $speed)
    {
        //dd(Auth::user()->name);
        //dd($position);
        event(new TruckMoved($latitude, $longitude, $speed, Auth::user()->name));
    }
    public function render()
    {
        return view('livewire.broadcast-position');
    }
}
