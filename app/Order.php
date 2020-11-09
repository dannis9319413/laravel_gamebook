<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['status', 'order_no', 'user_id', 'total', 'shipping', 'name', 'mobile', 'zipcode', 'county', 'district', 'address'];
}
