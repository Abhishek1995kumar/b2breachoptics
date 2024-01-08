<?php
  
namespace App;

use Illuminate\Database\Eloquent\Model;
  
class Country extends Model
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public $table = "b2b_countrymaster";
    protected $fillable = [
        'Name'
    ];
}