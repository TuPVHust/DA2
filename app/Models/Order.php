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
    protected $fillable=['name','partner_id','piority','status'];

    public function schedules_details(){
        return $this.hasMany(Schedule::class, 'order_id');
    }
}
