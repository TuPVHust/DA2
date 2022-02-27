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
use Illuminate\Support\Facades\Auth;

class AllNotificationModal extends Component
{
    protected $listeners = ['newNotificationCreated','removeNotifi'];
    public function removeNotifi($removedNotification)
    {
        //dd($id);
        $notifi= Auth::user()->notifications->find($removedNotification['id']);
        if($notifi)
        {
            $notifi->delete();
        }
    }
    public function newNotificationCreated($newNotifi){
        //dd($newNotifi);
        //dd('oki');
    }
    public function render()
    {
        $notifications = Auth::user()->notifications;
        return view('livewire.all-notification-modal',[
            'notifications' => $notifications,
        ]);
    }
}
