<?php
// class Postion {
//     public $lat;
//     public $lng;
//     public $dirver;
//     public $speed;
  
//     function __construct($lat, $lng,$speed, $driver) {
//       $this->lat = $lat;
//       $this->lng = $lng;
//       $this->speed = $speed;
//       $this->driver = $driver;
//     }
// }
namespace App\Http\Livewire;

use Livewire\Component;
Use App\Events\AskForPositionInfo;
class Tracking extends Component
{
    public $positionsArray = array();
    public $positions = null;
    protected $listeners = [
        'handlePositionsInfo',
        'askForPositionInfo',
    ];
    public function askForPositionInfo(){
        //dd('oki');
        
        event(new AskForPositionInfo());
    }
    public function handlePositionsInfo($positionsInfo){
        //dd($positionsInfo);
        // if(!in_array($positionsInfo['driver'], $this->positionsArray))
        // {
        //     $this->positionsArray[$positionsInfo['driver']] = $positionsInfo;
        // }
        $this->positionsArray[$positionsInfo['driver']] = $positionsInfo;
        //dd($this->positionsArray);
    }
    public function render()
    {
        
        return view('livewire.tracking',[
            'positionsArray' => $this->positionsArray,
        ]);
    }
}
