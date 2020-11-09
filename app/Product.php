<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['product_category_id', 'folder', 'name', 'description', 'price', 'pre', 'new', 'special'];
}
