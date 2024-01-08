<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    protected $table = 'brand_name';
    protected $fillable = ['name', 'category_id', 'status'];
    
    public $timestamps = false;
}
