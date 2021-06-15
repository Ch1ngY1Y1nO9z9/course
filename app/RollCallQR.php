<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RollCallQR extends Model
{
    protected $table = 'qrcode';

    protected $fillable = [
        'class_id', 'start_date', 'time', 'qrcode_path'
    ];
}
