<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $with = ['position'];

    //Relación uno a muchos inversa
    function position() {
        return $this->belongsTo(Position::class);
    }

    //Relacion uno a muchos
    public function shifts()
    {
        return $this->hasMany(Shift::class);
    }
}
