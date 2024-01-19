<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    const CONSECUTIVE_RECESS_DAYS = 1;
    const NO_CONSECUTIVE_RECESS_DAYS = 0;
}
