<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LensColor extends Model
{
    protected $table = 'lens_color';
    protected $fillable = ['name', 'status'];
}
