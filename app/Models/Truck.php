<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Truck extends Model
{
    use HasFactory;
    protected $table='trucks';
    protected $primaryKey = 'id';
    protected $fillable=['plate','figure','brand','capacity','owner_id','status'];
    
    public function schedules(){
        return $this.hasMany(Schedule::class, 'truck_id');
    }
    public function owner(){
        return $this->belongsTo(Partner::class, 'owner_id');
    }
}
