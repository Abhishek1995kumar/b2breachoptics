<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table = 'lens_material';
    protected $fillable = ['name', 'status'];
    
    public $timestamps = false;
}
