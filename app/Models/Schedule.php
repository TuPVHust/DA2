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
    protected $fillable=['description','driver_id','truck_id','shift','status','order_id','init_money'];
}
