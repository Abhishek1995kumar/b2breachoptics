<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactLensColor extends Model
{
    protected $table = 'contact_lens_color';
    protected $fillable = ['name', 'status'];
    
    public $timestamps = false;
}