<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['id','device_id','brand_id','model_id','customer_id','repair_items','barcode','order_total','status'];
}
