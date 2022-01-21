<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    use HasFactory;

    protected $table='schedules';
    protected $primaryKey = 'id';
    protected $fillable=['description','driver_id','truck_id','shift','status','init_money','car_owner_id','date'];

    public function schedule_details(){
        return $this->hasMany(ScheduleDetail::class, 'schedule_id');
    }
    public function cost_details(){
        return $this->hasMany(CostDetail::class, 'schedule_id');
    }
    public function truck(){
        return $this->belongsTo(Truck::class,'truck_id');
    }
    public function car_owner(){
        return $this->belongsTo(Partner::class,'car_owner_id');
    }
    public function driver(){
        return $this->belongsTo(User::class,'driver_id');
    }
}
