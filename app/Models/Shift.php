<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $with = ['employee', 'schedule', 'area', 'recess'];

    //Relación uno a muchos inversa
    function employee() {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    function schedule() {
        return $this->belongsTo(Schedule::class);
    }

    function area() {
        return $this->belongsTo(Area::class);
    }

    function recess() {
        return $this->belongsTo(Recess::class);
    }
}
