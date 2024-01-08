<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductAttr extends Model
{
    protected $table = "product_attrs";
    protected $fillable = ['attr_sku', 'attr_size', 'attr_qty', 'attr_mrp', 'attr_price', 'attr_color', 'product_id', 'created_at', 'updated_at'];
    
}
