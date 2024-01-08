<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Vendors extends Authenticatable
{
    use Notifiable;
    public $table = "vendor_profiles";
    protected $fillable = [
        'name', 'gender', 'email', 'shop_name','mname','lname','areaandstreet','landmark','addressproof', 'photo', 'phone', 'narration', 'password', 'fax', 'address', 'city','state','country', 'zip', 'note','current_balance', 'status', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];



    //  public function Product() 
    // {
    //     return $this->hasMany('App\Product');
    // }
}



