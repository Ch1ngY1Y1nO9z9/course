<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailRecord extends Model
{
    protected $table = "email_records";

    protected $fillable = [
        'filter', 'class_id', 'account_id', 'content', 'title'
    ];


    public function MailTo($record_id)
    {
        $record = $this->find($record_id);
        $filter = $record->filter;

        if($filter == 'all'){
            return '全部學生';
        }elseif($filter == 'class'){
            $course = Courses::find($record->class_id);

            return '班級: '.$course->class_name;
        }elseif($filter == 'student'){
            $student = User::where('account_id', $record->account_id)->first();

            return '學生: '.$student->name;
        }
    }
}
