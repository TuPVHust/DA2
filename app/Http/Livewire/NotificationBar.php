<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Carbon\Carbon;
use App\Notifications\createSchedule;
use Illuminate\Support\Facades\Auth;
use App\Notifications\completeSchedule;
class NotificationBar extends Component
{
    public $user;
    public $unreadNotifications;
    public function mount(){
    }

    public function markAsRead($notifi){
        // dd($this->user->unreadNotifications->when($notifi['id'], function ($query) use ($notifi) {
        //     return $query->where('id', $notifi['id']);
        // }));
        if($this->user->unreadNotifications->find('id',$notifi['id']))
        {
            $this->user->unreadNotifications->when($notifi['id'], function ($query) use ($notifi) {
                return $query->where('id', $notifi['id']);
            })->markAsRead();
        }
    }

    public function markAllAsRead(){
        $this->user->unreadNotifications->markAsRead();
    }
    public function render()
    {
        $this->user = Auth::user();
        $this->unreadNotifications = $this->user->unreadNotifications;
        return view('livewire.notification-bar');
    }
}
