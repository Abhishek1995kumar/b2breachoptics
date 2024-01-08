<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewBankDetail extends Model
{
    protected $table = "new_bank_details";
    protected $fillable = ['accountholdername','vendorid', 'accountnumber', 'bankname', 'ifsccode', 'accounttype',	'cancelcheck','passbook', 'status'];
    public $timestamps = false;
}
