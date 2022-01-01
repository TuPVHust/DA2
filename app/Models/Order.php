<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    use HasFactory;

    protected $table='orders';
    protected $primaryKey = 'id';
    protected $fillable=['partner_id','piority','status','summary','description','created_at'];

    public function schedules_details(){
        return $this.hasMany(Schedule::class, 'order_id');
    }

    public function partner(){
        return $this->belongsTo(Partner::class, 'partner_id');
    }
}
