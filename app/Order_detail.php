<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
    protected $fillable = ['order_id', 'product_id', 'folder', 'header', 'name', 'price', 'quantity'];
}
