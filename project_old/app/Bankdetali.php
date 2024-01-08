<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Bankdetali extends Model
{
    use Notifiable;
    public $table = "bankdetalis";
    protected $fillable = ['accountholdername','vendorid', 'accountnumber', 'bankname', 'ifsccode', 'accounttype',	'cancelcheck','passbook', 'status'];
    public $timestamps = false;
}
