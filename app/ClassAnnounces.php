<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassAnnounces extends Model
{
    protected $table = 'class_announces';

    protected $fillable = [
        'title', 'content', 'files', 'start_date', 'end_date', 'class_id', 'soft_delete','pushed'
    ];

    public function announces()
    {
        return $this->belongsTo('App\Courses','class_id');
    }

    // 轉換上下架時間
    public function getDate($value)
    {
        return date("Y-m-d H:i", strtotime($value));
    }

    // 查看課程公告(學生端)
    public function scopeGetPushedAnnounce($query, $class_id)
    {
        return $this->where('class_id', $class_id)
                    ->where('soft_delete', 0);
    }

    // 查看課程公告(Admin端)
    public function scopeGetAllAnnounce($query, $class_id)
    {
        return $this->where('class_id', $class_id);
    }
}
