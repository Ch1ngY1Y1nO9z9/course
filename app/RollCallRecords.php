<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RollCallRecords extends Model
{
    protected $table = "roll_call_records";

    protected $fillable = [
        'course_id', 'students_id','date'
    ];
}
