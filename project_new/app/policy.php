<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class policy extends Model
{
	protected $table = 'policies';
     protected $fillable = ['titles', 'details'];
}
