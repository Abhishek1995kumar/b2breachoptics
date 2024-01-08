<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductGallery extends Model
{
    protected $table = 'product_attr_gallery';

    protected $fillable = ['attr_imgs', 'color', 'attr_color_code', 'pid', 'paid'];

    public $timestamps = false;
}