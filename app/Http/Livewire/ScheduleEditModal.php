<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ScheduleEditModal extends Modal
{
    public $message = '';
    public $show =false;
    protected $listeners = ['show',];
    public function show(){
        // dd('oki');
        $this->show = true;
    }
    public function mount()
    {
        $this->message = 'Welcome to the reusable modal example';
    }
    public function render()
    {
        return view('livewire.schedule-edit-modal');
    }
}
