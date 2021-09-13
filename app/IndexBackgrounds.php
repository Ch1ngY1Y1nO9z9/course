<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IndexBackgrounds extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'block', 'background_link','background_size'
    ];

    public function checkSection($section)
    {
        if($section == 'main'){
            return '主區塊';
        }elseif($section == 'news'){
            return '新聞'; 
        }elseif($section == 'schedule'){
            return '行事曆';  
        }elseif($section == 'download'){
            return '下載'; 
        }elseif($section == 'video'){
            return '影片'; 
        }
    }

    public function checkSize($section)
    {
        if($section == 'main'){
            return '1365';
        }elseif($section == 'news'){
            return '996'; 
        }elseif($section == 'schedule'){
            return '1270';  
        }elseif($section == 'download'){
            return '441'; 
        }elseif($section == 'video'){
            return '450'; 
        }
    }
}
