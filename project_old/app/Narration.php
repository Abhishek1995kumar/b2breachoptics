<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Narration extends Model
{
    protected $table = 'narration';
    protected $fillable = ['narration', 'status'];
    public $timestamps = false;
}
