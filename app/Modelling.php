<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modelling extends Model
{
    protected $fillable = ['id','model_name','brand_id'];

    public function brands()
    {
        return $this->belongsTo(Brand::class,'id','id');
    }
}
