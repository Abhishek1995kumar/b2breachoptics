<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <title>Invoice</title>
    <style type="text/css" media="screen">
        #invoice{
            padding:-30px;  
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
        
        .invoice_header {
            padding : 0px 20px 0px 20px;
            /*margin-top : -20px;*/
        }
        
        .padding_left_right {
            padding : 0px 20px 0px 20px;
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
            padding-left : 100px;
            font-family: 'Montserrat', sans-serif;
            font-size : 20px;
            font-weight : 700;
        }
        
        /*.order_product_div table,th, td {*/
        /*        padding: 10px;*/
        /*        border: 1px solid black;*/
        /*        border-collapse: collapse;*/
        /*      }*/
        
        .invoice {
            position: relative;
            background-color: #FFF;
            min-height: 680px;
            padding: 20px
        }
        
        .company-details {
            text-align: center
        }
        
        .company-details .name {
            margin-top: 0;
            margin-bottom: 0
        }
        
        .invoice .contacts {
            margin-bottom: 20px
        }
        
        .invoice .invoice-to {
            text-align: left
        }
        
        .invoice .invoice-to .to {
            margin-top: 0;
            margin-bottom: 0
        }
        
        .invoice .invoice-details {
            text-align: right
        }
        
        .invoice .invoice-details .invoice-id {
            margin-top: 0;
            color: #3989c6
        }
        
        /*main {*/
        /*    padding-bottom: 50px*/
        /*}*/
        
        main .thanks {
            margin-top: -100px;
            font-size: 2em;
            margin-bottom: 30px
        }
        
        .invoice main .notices {
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
            margin-bottom: 5px;
            margin-top: 5px;
        }
        
        table td,.invoice table th {
            padding: 20px;
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
        
        .invoice table .unit {
            background: #ddd
        }
        
        .invoice table .total {
            background: #3989c6;
            color: #fff
        }
        
        .invoice table tbody tr:last-child td {
            border: 1px solid #000;
            
        }
        
        table tfoot td {
            background: 0 0;
            white-space: nowrap;
            text-align: right;
            padding: 20px 20px;
            font-size: 12px;
            border-top: 1px solid #000;
            border-right:1px solid #000;
             /*border-left:1px solid #000;*/
              border-bottom:1px solid #000;
        }
        
        table tfoot tr:first-child td {
           border-top: 1px solid #000;
        }
        
        table tfoot tr td:last-child  {
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
            padding: 8px 0
        }
        
        @media print {
            .invoice {
                font-size: 11px!important;
                overflow: hidden!important
            }
        
            .invoice footer {
                position: absolute;
                bottom: 10px;
                page-break-after: always
            }
        
            .invoice>div:last-child {
                page-break-before: always
            }
        }
    </style>
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">-->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        $('#printInvoice').click(function(){
            Popup($('.invoice')[0].outerHTML);
            function Popup(data) 
            {
                window.print();
                return true;
            }
        });
    </script>
</head>
<body>
    <div id="invoice">
    <div class="invoice_header">
        <table width="100%">
        <tr>
            <td align="left" style="width: 50%;">
                <a  target="_blank"><img alt="Reach logo" src="{{ URL::asset('assets/images/logo')}}/{{$settings[0]->logo}}" data-holder-rendered="true">
                </a>
                <p>
                    <b>Order ID:</b> {{$orders->orderid}}<br>
                    <b>Item ID:</b> {{$orders->id}}<br>
                    <b>Order Date:</b> {{$orders->booking_date}}<br>
                </p>
            </td>
            <td align="left" style="width: 50%;">
                <h3 class="text-dark" style="margin-bottom:10px; font-sixe:20px; font-weight:900;">{{$orders->A_Name}}</h3>
                <div>{{$array['address1']}}</div>
                <div>{{$array['address2']}}</div>
                <!--<div>Email: {{$orders->A_Email}}</div>-->
                <div>Email: support@elricaglobal.in</div>
                <!--<div>Phone: {{$orders->A_Phone}}</div>-->
                <div>Phone: 7700044084</div>
                <div>Invoice: {{$orders->invoice_number}}</div>
            </td>
        </tr>
    </table>
    </div>
    
    <div class="padding_left_right customer_address_div">
        <table width="100%">
        <tr>
            <td align="left" style="width: 50%;">
                <h4>Billing Address : </h4>
                <p><b>{{$orders->bussiness_name}}</b><br>
                    {{$orders->buyer_address}}<br>
                    {{$orders->buyer_address2}}<br>
                    {{$orders->buyer_city}} {{$orders->buyer_state}}<br>
                    {{$orders->customer_country}} 
                    {{$orders->customer_zip}}<br>
                    {{$orders->buyer_phone}}
                    {{$orders->customer_alt_phone}}
                </p>
            </td>
            
            <td align="right" style="width: 50%;">
                <h4>Shipping Address : </h4>
                @if($orders->shipping_address != '')
                    <p><b>{{$orders->shipping_name}}</b><br>
                        {{$orders->shipping_address}}<br>
                        {{DB::table('b2b_citymaster')->where('id', $orders->shipping_city)->get()[0]->Name}} {{DB::table('b2b_statemaster')->where('id', $orders->shipping_state)->get()[0]->Name}}<br>
                        {{DB::table('b2b_countrymaster')->where('id', $orders->shipping_country)->get()[0]->Name}} 
                        {{$orders->shipping_zip}}<br>
                        {{$orders->shipping_phone}} 
                        {{$orders->shipping_alternate_phone}}
                    </p>
                @else
                    <p><b>{{$orders->bussiness_name}}</b><br>
                        {{$orders->buyer_address}}<br>
                        {{$orders->buyer_city}} {{$orders->buyer_state}}<br>
                        {{$orders->customer_country}} 
                        {{$orders->customer_zip}}<br>
                        {{$orders->buyer_phone}} 
                        {{$orders->customer_alt_phone}}
                    </p>
                @endif
            </td>
        </tr>
        </table>
    </div>
    
    <div class="padding_left_right customer_address_div">
        <table width="100%">
        <tr>
            <td align="left" style="width: 50%;">
                <!--<h4>Shipping Address : </h4>-->
                <p>
                    PAN : AAFCE6495B<br>
                    GSTIN : 27AAFCE6495B1ZK<br>
                    Place of supply: MAHARASHTRA<br>
                    Place of delivery: {{$orders->buyer_state}}<br>
                    
                </p>
            </td>
        </tr>
        </table>
    </div>
    
    <div class="padding_left_right">
        <h4>Order Product : </h4>
        <table width="100%" border="1" style="border-collapse: collapse; padding: 10px;">
         <thead>
            <tr>
            <!--<th></th>-->
            <th style="padding: 10px; background-color : #f2f2f2;" colspan="4" class="text-left">Description</th>
                    <th style="padding: 10px; background-color : #f2f2f2;" colspan="2" class="text-right">Price</th>
                    <th style="padding: 10px; background-color : #f2f2f2;" colspan="2" class="text-right">Quantity</th>
                    <th style="padding: 10px; background-color : #f2f2f2;" colspan="2" class="text-right">Tax Rate</th>
                    <th style="padding: 10px; background-color : #f2f2f2;" colspan="2" class="text-right">Tax Type</th>
                    <th style="padding: 10px; background-color : #f2f2f2;" colspan="2" class="text-right">Tax Amount</th>
                    <th style="padding: 10px; background-color : #f2f2f2;" colspan="2" class="text-right">Subtotal</th>
            </tr>
        </thead>
        
        <tbody >
            <tr>
                <!--<td></td>-->
                <td style="padding: 10px;" colspan="4" class="text-left">{{$orders->product_title}}</td>
                <td style="padding: 10px;" colspan="2" class="text-right">{{$orders->cost}}</td>
                <td style="padding: 10px;" colspan="2" class="text-right">{{$orders->quantity}}</td>
                @if($orders->categoryID == 72 || $orders->categoryID == 53 || $orders->premiumtype == 'Frames')
                    <td style="padding: 10px;" colspan="2" class="text-right">12%</td>
                @elseif($orders->categoryID == 63 || $orders->categoryID == 87 || $orders->premiumtype == 'Sunglasses')
                    <td style="padding: 10px;" colspan="2" class="text-right">18%</td>
                @else
                    <td style="padding: 10px;" colspan="2" class="text-right">0%</td>
                @endif
                
                @if($orders->shipping_address == '')
                    @if(strtolower($orders->buyer_state) == 'maharashtra' || strtolower($orders->buyer_state) == 'maharastra' || strtolower($orders->buyer_state) == 'Maharashtra')
                        <td style="padding: 10px;" colspan="2" class="text-right">CGST <?php echo " / "?> SGST</td>
                    @else
                        <td style="padding: 10px;" colspan="2" class="text-right">IGST</td>
                    @endif
                @else
                    @if(strtolower($orders->shipping_state) == '22')
                        <td style="padding: 10px;" colspan="2" class="text-right">CGST <?php echo " / "?> SGST</td>
                    @else
                        <td style="padding: 10px;" colspan="2" class="text-right">IGST</td>
                    @endif
                @endif
                <td style="padding: 10px;" colspan="2" class="text-right">{{$emi}}</td>
                <!--<td style="padding: 10px;" colspan="2" class="text-right">{{$orders->pay_amount}}</td>-->
                <td style="padding: 10px;" colspan="2" class="text-right">{{$subtotal}}</td>
            </tr>
        </tbody>
        <tfoot>
            <!--<tr>-->
            <!--    <td colspan="4"></td>-->
            <!--    <td style="text-align : right;padding: 10px;" colspan="8">Tax</td>-->
            <!--    <td colspan="2" style="padding: 10px;">{{round($settings[0]->tax,2)}}%</td>-->
            <!--</tr>-->
            <!--<tr>-->
            <!--    <td colspan="4"></td>-->
            <!--    <td style="text-align : right; padding: 10px;" colspan="8">Discount</td>-->
            <!--    <td colspan="2" style="padding: 10px;">{{round($settings[0]->	fixed_commission,2)}}%</td>-->
            <!--</tr>-->
            <!--   <tr>-->
            <!--    <td colspan="4"></td>-->
            <!--    <td style="text-align : right; padding: 10px;" colspan="8">Shipping Cost</td>-->
            <!--    <td colspan="2" style="padding: 10px;">{{round($settings[0]->shipping_cost,2)}}</td>-->
            <!--</tr>-->
            <tr>
                <td colspan="4"></td>
                <td style="text-align : right; padding: 10px; background-color : #f2f2f2; font-size:18px; font-weight:800;" colspan="8">Grand Total</td>
                <td colspan="4" style="padding: 10px; background-color : #f2f2f2; text-align: left;"><b>{{$subtotal}}</b></td>
            </tr>
        </tfoot>
        <tfoot>
            <tr>
                <td style="text-align : left; padding: 10px;" colspan="16">
                    <h3>For Reach</h3>
                    <h4 style="color:#000;">Autherized Signatory</h4>
                </td>
            </tr>
        </tfoot>
        
        
        </table>
    </div>
    
            <main>
            
                <!--<div class="thanks">Thank you!</div>-->
                <!--<div class="notices">-->
                <!--    <div>NOTICE:</div>-->
                    <!--<div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>-->
                <!--</div>-->
            </main>
            <footer style="text-align : center; color : #808080">
                Invoice was created on a computer and is valid without the signature and seal.
            </footer>
        </div>
        <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
        <div></div>
    </div>
</div>
</body></html>