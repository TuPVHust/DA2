<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleDetail extends Model
{
    use HasFactory;
    protected $table='schedules';
    protected $primaryKey = 'id';
    protected $fillable=['schedule_id','seller_id','buyer_id','category_id','order_id','price','actual_price','revenue','actual_revenue','description','distance'];
}
