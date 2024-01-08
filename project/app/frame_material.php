<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Frame_material extends Model
{
    protected $table = 'frame_material';
    protected $fillable = ['name', 'status'];
    
    public $timestamps = false;
}