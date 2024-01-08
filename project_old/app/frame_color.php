<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Frame_color extends Model
{
    protected $table = 'frame_color';
    protected $fillable = ['name', 'status'];
    
    public $timestamps = false;
}