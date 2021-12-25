<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table='categories';
    protected $primaryKey = 'id';
    protected $fillable=['name',];

    public function schedule_details(){
        return $this->hasMany(ScheduleDetail::class, 'category_id');
    }
}
