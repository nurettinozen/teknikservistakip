<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    // ,'name','surname','phone','gsm','address','identity_number','type','company_name','tax_number','tax_authority'
    // Lazım olursa eklemek için...
    protected  $fillable = ['id','name','surname','phone','gsm','address','identity_number','type','company_name','tax_number','tax_authority'];
}
