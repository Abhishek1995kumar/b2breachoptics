<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contactlens_packeging extends Model
{
    protected $table = 'contactlens_packeging';
    protected $fillable = ['name', 'status'];
    
    public $timestamps = false;
}