<?php

namespace App\CustomService;

use DB;

class Invoice {
    public function invoiceGenerate($request, $invoice){

        $order_id =  isset($request->all()['order_id']) ? $request->all()['order_id'] : '';
        DB::enableQueryLog();
        $datas = DB::table('ordered_products as op')
        ->where('op.orderid', '=', $order_id)
        ->where('op.status', '=',$request->status)
        ->leftjoin('orders as o', 'op.orderid', '=', 'o.id')
        ->leftjoin('categories', 'categories.id', '=', 'op.categoryID')
        ->leftjoin('categories as k','k.name', '=', 'op.premiumtype')
        ->leftjoin('products as pro', 'op.productid', '=', 'pro.id')
        ->leftjoin('user_profiles','o.customer_phone', '=', 'user_profiles.phone')
        ->leftjoin('b2b_citymaster','op.buyer_city','=','b2b_citymaster.id')
        ->leftjoin('b2b_statemaster','op.buyer_state','=','b2b_statemaster.id')
        ->leftjoin('b2b_citymaster as sbc','o.shipping_city','=','sbc.Id')
        ->leftjoin('b2b_statemaster as sbs','o.shipping_state','=','sbs.id')
        ->select('user_profiles.*','op.*','o.customer_name as buyer_name','b2b_statemaster.Name as buyer_state',
        'b2b_citymaster.Name as buyer_city','o.customer_Address as address','o.customer_zip as pincode','k.tax as tax1',
        'o.customer_email as cus_email','pro.modelno as modelno','pro.hsncode as hsn_code','pro.costprice as cost_price',
        'o.pay_amount as pay_amount', 'o.shipping_name', 'o.shipping_phone', 'o.shipping_address', 'o.shipping_address2', 'o.shipping_city', 
        'o.shipping_state', 'o.shipping_country', 'o.shipping_zip', 'categories.tax as tax', 'sbc.Name as Ship_city', 'sbs.Name as Ship_state')
        ->orderBy('op.orderid','desc');

        if($request->invoice != ""){
            $datas->where('op.invoice_number', '=', $request->invoice);
        }
        else{
            $datas->where('op.invoice_number', '=', $invoice);
        }
        $order_details = $datas->get();
        return $order_details;
    }
}