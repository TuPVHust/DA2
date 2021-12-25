<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CostGroup extends Model
{
    use HasFactory;

    protected $table='cost_groups';
    protected $primaryKey = 'id';
    protected $fillable=['name',];

    public function cost_details(){
        return $this.hasMany(CostDetail::class, 'cost_group_id');
    }
}
