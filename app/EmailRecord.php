<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailRecord extends Model
{
    protected $table = "email_records";

    protected $fillable = [
        'filter', 'class_id', 'account_id', 'content', 'title'
    ];
}
