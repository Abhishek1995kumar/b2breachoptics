<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Frame_shape extends Model
{
    protected $table = 'frame_shape';
    protected $fillable = ['name', 'status'];
    
    public $timestamps = false;
}