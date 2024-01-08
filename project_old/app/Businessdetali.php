<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Businessdetali extends Model
{
    use Notifiable;
    public $table = "businessdetalis";
    protected $fillable = ['businessname','vendorid', 'addressone', 'addresstwo', 'landmark', 'city','state', 'country', 'pincode', 'companytype',
                            'businesstype', 'yoe', 'ppoyc', 'gst', 'pan', 'adhar', 'tan', 'status', 'adharimg', 'trademarkimg', 'udyamimg', 'companylogo'];
    public $timestamps = false;
}
