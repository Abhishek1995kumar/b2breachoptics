<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrderedProducts;

class api extends Controller
{
    //

    public function demo()
    {
    	return OrderedProducts::all();
    }

    public function pushorder($id){	

    	$getAllOrders = OrderedProducts::pushOrder($id);
    	return response()->json(['status'=>$getAllOrders]);

    }


}
