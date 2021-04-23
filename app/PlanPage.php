<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanPage extends Model
{
    protected $table = "plan_page";

    public function plan_article()
    {
        return $this->hasMany('App\PlanArticle','pid');
    }
}
