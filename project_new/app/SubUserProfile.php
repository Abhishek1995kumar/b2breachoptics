<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class SubUserProfile extends Authenticatable
{
    use Notifiable;
    // public $table = "subusers";user_profiles

    public $table = "user_profiles";
    protected $fillable = [
        'user_id', 'name','mname','lname', 'gender', 'email', 'phone', 'password', 'fax', 'address', 'address2', 'state', 'country', 'alternate_phone', 'city', 'zip', 'status', 'created_at', 'updated_at', 'status'
    ];

    // public function postedBy()
    //   {
    //      return $this->belongsTo('App\Order','id');
    //   }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];
}