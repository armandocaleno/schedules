<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $with = ['period', 'recesses'];

    //Relación uno a muchos inversa
    function period() {
        return $this->belongsTo(Period::class);
    }

    //Relacion muchos a muchos
    public function recesses()
    {
        return $this->belongsToMany(Recess::class);
    }
}
