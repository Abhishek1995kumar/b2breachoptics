<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserProfile extends Authenticatable
{
    use Notifiable;
    public $table = "user_profiles";
    protected $fillable = [
        'user_id', 'name','mname','lname', 'gender', 'email','bussiness_name','bank_name','acc_no','ifsc_code','aadhar_card','phone', 'password', 'fax', 'address', 'address2', 'state', 'country', 'alternate_phone','gst_no', 'id_proof', 'shop_act_lic', 'udyam_cert', 'city', 'zip', 'status','logindetailsstatus','costpriceshow', 'created_at', 'updated_at'
    ];
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];
}
