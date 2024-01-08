<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public $table = "b2b_citymaster";
    protected $fillable = [
        'Name', 'StateId'
    ];
}