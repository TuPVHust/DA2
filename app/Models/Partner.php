<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;
    use HasFactory;

    protected $table='partners';
    protected $primaryKey = 'id';
    protected $fillable=['name','phone','NCC','NM','car_owner'];

    public function orders(){
        return $this->hasMany(Order::class, 'partner_id');
    }
    public function schedule_details_as_buyer(){
        return $this->hasMany(ScheduleDetail::class, 'buyer_id');
    }
    public function schedule_details_as_seller(){
        return $this->hasMany(ScheduleDetail::class, 'seller_id');
    }
    public function trucks(){
        return $this->hasMany(Truck::class, 'owner_id');
    }
}
