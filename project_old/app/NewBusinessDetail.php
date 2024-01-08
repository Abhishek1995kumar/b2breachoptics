<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewBusinessDetail extends Model
{
    protected $table = "new_business_details";
 	protected $fillable = ['businessname','vendorid', 'addressone', 'addresstwo', 'landmark', 'city','state', 'country', 'pincode', 'companytype', 'businesstype', 'yoe', 'ppoyc', 'gst', 'pan', 'adhar', 'tan', 'adharimg', 'trademarkimg', 'udyamimg', 'companylogo', 'status'];
    public $timestamps = false;
}
