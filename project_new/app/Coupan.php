<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupan extends Model {
    protected $table = 'coupans';

    protected $fillable = [
        'userid',
        'coupon_description',
        'coupan_amount',
        'start_date',
        'coupan_code',
        'b2b_code',
        'coupan_type',
        'validity',
        'validitytype',
        'min_purchase_amount',
        'uses_period',
    ];
}