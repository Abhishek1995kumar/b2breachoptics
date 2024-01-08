<!DOCTYPE html>
<html>
<head>
	<title>Acknoeledgement Slip</title>
	<style type="text/css">
        #container{
            padding:0;  
            font-family: 'Montserrat', sans-serif;
            margin : 0;
        }
    
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
        body {
            font-family: 'Montserrat', sans-serif;
            margin : 0;
            padding : 0;
        }
        .text-align-left {
            text-align : left;
        }
        
        .text-align-right {
            text-align : right;
        }
        
        .card-header {
            padding : 0px 5px 0px 5px;
            /*margin-top : -20px;*/
        }
        
        .padding_left_right {
            padding : 0px 5px 0px 5px;
        }
        
        .pading-top-0 {
            padding-top : 0;
        }
        .margin-top-0 {
            margin-top : 0;
        }
        
        
        .tax_invoice_text {
            margin : 0;
            padding : 0;
            padding-left : 40px;
            font-family: 'Montserrat', sans-serif;
            font-size : 20px;
            font-weight : 700;
        }
        
        /*.order_product_div table,th, td {*/
        /*        padding: 10px;*/
        /*        border: 1px solid black;*/
        /*        border-collapse: collapse;*/
        /*      }*/
        
        .container {
            width:100%;
            position: relative;
            background-color: #FFF;
            min-height: 400px;
            padding: 10px
        }
        
        .company-details {
            text-align: center
        }
        
        .company-details .name {
            margin-top: 0;
            margin-bottom: 0
        }
        
        .container .contacts {
            margin-bottom: 10px
        }
        
        .container .invoice-to {
            text-align: left
        }
        
        .container .invoice-to .to {
            margin-top: 0;
            margin-bottom: 0
        }
        
        .container .invoice-details {
            text-align: right
        }
        
        .container .invoice-details .invoice-id {
            margin-top: 0;
            color: #3989c6
        }
        
        main {
            padding-bottom: 50px
        }
        
        main .thanks {
            margin-top: -100px;
            font-size: 2em;
            margin-bottom: 10px
        }
        
        .container main .notices {
            padding-left: 6px;
            border-left: 6px solid #3989c6
        }
        
        main .notices .notice {
            font-size: 12px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 10px;
            margin-top: 10px;
        }
        
        .invoice table td,.invoice table th {
            padding: 10px;
            background: #eee;
            border: 1px solid #000;
        }
        
        table th {
            white-space: nowrap;
            font-weight: 400;
            font-size: 16px;
            background-color:skyblue;
        }
        
        table td h3 {
            margin: 0;
            font-weight: 400;
            color: #3989c6;
            font-size: 1.2em
        }
        
        table .qty,.invoice table .total,.invoice table .unit {
            text-align: right;
            font-size: 1.2em
        }
        
        table .no {
            color: #fff;
            font-size: 1.6em;
            background: #3989c6
        }
        
        .container table .unit {
            background: #ddd
        }
        
        .container table .total {
            background: #3989c6;
            color: #fff
        }
        
        .container table tbody tr:last-child td {
            border: 1px solid #000;
            
        }
        
        .container table tfoot td {
            background: 0 0;
            white-space: nowrap;
            text-align: right;
            padding: 20px 20px;
            font-size: 12px;
            border:1px solid #000;
        }
        
        .container table tfoot tr:first-child td {
           border-top: 1px solid #000;
        }
        
        .container table tfoot tr td:last-child  {
            color: #3989c6;
            font-size:15px;
            border-top: 1px solid #000;
        }
        
        table tfoot tr td:first-child {
            border: 1px solid #000;
        }
        
        footer {
            width: 100%;
            text-align: center;
            color: #777;
            border-top: 1px solid #000;
            padding: 8px 0;
        }
        
        table input {
            border-bottom: 1px solid #000;
            background:none;
        }
        
        @media print {
            .container {
                font-size: 11px!important;
                overflow: hidden!important
            }
        
            .container footer {
                position: absolute;
                bottom: 10px;
                page-break-after: always
            }
        
            .container>div:last-child {
                page-break-before: always
            }
        }
    </style>
</head>
<body>

    <div id="container">
        <div class="card-header">
            <table width="100%">
                <tr>
                    <td align="left" style="width: 50%;">
                        <a  target="_blank"><img alt="Reach logo" src="{{ URL::asset('assets/images/logo')}}/{{$settings[0]->logo}}" data-holder-rendered="true">
                        </a>
                        <p>
                            <b>Order ID:</b> {{$order->order_number}}<br>
                            <b>Order Date:</b> {{$order->booking_date}}<br>
                            <b>Tracking ID:</b> <br>
                        </p>
                    </td>
                    <td align="left" style="width: 50%;">
                        <h3 class="text-dark">{{$order->A_Name}}</h3>
                        <div>{{$array['address1']}}</div>
                        <div>{{$array['address2']}}</div>
                        <div>Email: {{$order->A_Email}}</div>
                        <div>Phone: {{$order->A_Phone}}</div>
                    </td>
                </tr>
            </table>
        </div>
        <div class="padding_left_right customer_address_div">
            <table width="100%">
                <tr>
                    <td align="left" style="width: 50%;">
                        <h4>Billing Address : </h4>
                        <p><b>{{$order->buyer_name}}</b><br>
                            {{$order->buyer_address}}<br>
                            {{$order->buyer_city}} {{$order->buyer_state}}<br>
                            {{$order->customer_country}} 
                            {{$order->customer_zip}}<br>
                            {{$order->buyer_phone}} 
                            {{$order->customer_alt_phone}}
                        </p>
                    </td>
                    
                    <td align="right" style="width: 50%;">
                        <h4>Shipping Address : </h4>
                        @if($order->shipping_address != '')
                            <p><b>{{$order->shipping_name}}</b><br>
                                {{$order->shipping_address}}<br>
                                {{$order->shipping_city}} {{$order->shipping_state}}<br>
                                {{$order->shipping_country}} 
                                {{$order->shipping_zip}}<br>
                                {{$order->shipping_phone}} 
                                {{$order->shipping_alternate_phone}}
                            </p>
                        @else
                            <p><b>{{$order->buyer_name}}</b><br>
                                {{$order->buyer_address}}<br>
                                {{$order->buyer_city}} {{$order->buyer_state}}<br>
                                {{$order->customer_country}} 
                                {{$order->customer_zip}}<br>
                                {{$order->buyer_phone}} 
                                {{$order->customer_alt_phone}}
                            </p>
                        @endif
                    </td>
                </tr>
            </table>
        </div>
        
        <div class="padding_left_right">
            <h4>Order Product : </h4>
            <table width="100%" style="border-collapse: collapse; height:150px; border:none;">
                <tfoot style="border:1px solid #000;">
                    <tr style="padding: 5px; border:none;">
                        <td style="text-align : left; padding: 10px; background-color : #f2f2f2; border:none;" colspan="8">
                            Pickup in time : <input type="text" class="form-control" style="align: right;">
                        </td>
                        
                        <td colspan="8" style="padding: 10px; background-color : #f2f2f2; text-align: left; border:none">
                            Total times : <input type="text" class="form-control" style="align: right;">
                        </td>
                    </tr>
                    <tr style="padding: 5px; border:none;">
                        <td style="text-align : left; padding: 10px; background-color : #f2f2f2; border:none;" colspan="8">

                            Pickup out time : <input type="text" class="form-control" style="align: right;">
                        </td>
                        
                        <td colspan="8" style="padding: 10px; background-color : #f2f2f2; text-align: left; border:none;">
                            S. Name : <input type="text" class="form-control" value="{{$order->A_Name}}" style="align: right;">

                        </td>
                    </tr>
                    <tr style="padding: 5px; border:none;">
                        <td style="text-align : left; padding: 10px; background-color : #f2f2f2; border:none;" colspan="8">

                            PP Name : <input type="text" class="form-control" style="align: right;">
                        </td>
                            
                        <td colspan="8" style="padding: 10px; background-color : #f2f2f2; text-align: left; border:none;">
                            S. Signature : <input type="text" class="form-control" style="align: right;">
                            
                            <!--PP Signature : <input type="text" class="form-control" style="align: right;"><br>-->
                        </td>
                    </tr>
                    
                    <tr style="padding: 5px; border:none;">
                        <td colspan="16" style="padding: 10px; background-color : #f2f2f2; text-align: left; border:none;">
                            
                            PP Signature : <input type="text" class="form-control" style="align: right;">
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

</body>
</html>