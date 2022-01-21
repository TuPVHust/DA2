<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleDetail extends Model
{
    use HasFactory;
    protected $table='schedule_details';
    protected $primaryKey = 'id';
    protected $fillable=['schedule_id','seller_id','buyer_id','category_id','order_id','price','actual_price','revenue','actual_revenue','description','distance','quantity'];

    public function schedule(){
        return $this->belongsTo(Schedule::class,'schedule_id');
    }
    public function seller(){
        return $this->belongsTo(Partner::class,'seller_id');
    }
    public function buyer(){
        return $this->belongsTo(Partner::class,'buyer_id');
    }
    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
    public function order(){
        return $this->belongsTo(Order::class,'order_id');
    }
}
