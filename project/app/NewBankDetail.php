<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewBankDetail extends Model
{
     protected $fillable = ['accountholdername','vendorid', 'accountnumber', 'bankname', 'ifsccode', 'accounttype',	'cancelcheck','passbook'];
    public $timestamps = false;
}
