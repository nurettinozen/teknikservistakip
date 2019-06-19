<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $fillable = ['id','brand_id','model_id','customer_id','pre_detection','customer_request','repair_description','delivered_person','delivery_person','serial_number','barcode','status'];
}
