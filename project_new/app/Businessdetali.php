<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Businessdetali extends Model
{
    protected $fillable = ['businessname','vendorid', 'addressone', 'addresstwo', 'landmark', 'city','state', 'country', 'pincode', 'companytype', 'businesstype', 'yoe', 'ppoyc', 'gst', 'pan', 'adhar', 'tan'];
    public $timestamps = false;
}
