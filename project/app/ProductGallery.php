<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductGallery extends Model
{
    protected $table = 'product_attr_gallery';

    protected $fillable = ['attr_imgs', 'pid', 'paid', 'attr_color_code'];

    public $timestamps = false;
}