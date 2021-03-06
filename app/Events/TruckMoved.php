<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TruckMoved implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $lat;
    public $lng;
    public $speed;
    public $driver;
    public $timeStamp;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($lat, $lng, $speed,$timeStamp, $driver)
    {
        $this->lat = $lat;
        $this->lng = $lng;
        $this->driver = $driver;
        $this->speed = $speed;
        $this->timeStamp = $timeStamp;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('chatBoxApp');
        //return new PrivateChannel('channel-name');
    }
}
