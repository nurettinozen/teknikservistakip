<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    protected $fillable = ['id','brand_id','model_id','component_name','stock','get_price','sell_price'];
}
