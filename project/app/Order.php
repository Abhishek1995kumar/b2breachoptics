<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['customerid', 'products', 'cost', 'quantities', 'sizes', 'method','shipping', 'pickup_location', 'pay_amount', 'txnid', 'charge_id', 'order_number', 'payment_status', 'customer_email', 'customer_name', 'customer_phone', 'customer_address', 'customer_address2', 'customer_city', 'customer_state',  'customer_country', 'customer_alt_phone' ,'customer_zip','shipping_name', 'shipping_email', 'shipping_phone', 'shipping_address', 'shipping_address2', 'shipping_city', 'shipping_state', 'shipping_country', 'shipping_alternate_phone', 'shipping_zip', 'order_note', 'buyer_order_id','seller_order_id', 'booking_date', 'status','cancelreason','comment','pickupaddress','product_image', 'couponAmount'];
    public $timestamps = false;
    public static $withoutAppends = false;

    public function getProductsAttribute($products)
    {
        if(self::$withoutAppends){
            return $products;
        }
        return explode(',',$products);
    }
    public function getQuantitiesAttribute($quantities)
    {
        if(self::$withoutAppends){
            return $quantities;
        }
        return explode(',',$quantities);
    }

}
