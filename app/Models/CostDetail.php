<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CostDetail extends Model
{
    use HasFactory;

    protected $table='cost_details';
    protected $primaryKey = 'id';
    protected $fillable=['schedule_id','cost_group_id','cost','actual_cost','description',];

    public function schedule(){
        return $this->belongsTo(Schedule::class);
    }
}
