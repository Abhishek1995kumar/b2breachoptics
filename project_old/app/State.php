<?php
  
namespace App;
use Illuminate\Database\Eloquent\Model;
  
class State extends Model
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public $table = "b2b_statemaster";
    protected $fillable = [
        'Name', 'CountryId'
    ];
}