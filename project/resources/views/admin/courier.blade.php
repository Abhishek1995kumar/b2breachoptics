<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Dropdowns</h2>
  
 



<select name="courier_id" style="width:50%;" id="courier_id">
    <option value='non'>Select an exam...</option>
    <option value='1'>Blue Dart</option>
    <option value='2'>FedEx</option>
    <option value='7'>FEDEX PACKAGING</option>
    <option value='8'>DHL Packet International</option>
    <option value='10'>Delhivery</option>
    <option value='12'>FedEx Surface 10 Kg</option>
    <option value='14'>Ecom Express</option>
    <option value='16'>Dotzot</option>
    <option value='33'>Xpressbees</option>
    
    <option value='35'> Aramex International</option>
    <option value='37'>DHL PACKET PLUS INTERNATIONAL</option>
    <option value='38'>DHL PARCEL INTERNATIONAL DIRECT</option>
    <option value='39'>Delhivery Surface 5 Kgs</option>
    <option value='40'>Gati Surface 5 Kg</option>
    <option value='41'>FedEx Flat Rate</option>
    <option value='42'>FedEx Surface 5 Kg</option>
    <option value='43'>Delhivery Surfaceg</option>
    <option value='44'>Delhivery Surface 2 Kgs</option>
  
    <option value='45'>Ecom Express Reverse</option>
    <option value='46'>Shadowfax Reverse</option>
    <option value='48'>Ekart Logistics</option>
    <option value='50'>Wow Express</option>
    <option value='51'>Xpressbees Surface</option>
    <option value='52'>RAPID DELIVERY</option>
    <option value='53'>Gati Surface 1 Kg</option> 
    <option value='54'>Ekart Logistics Surface</option>
    <option value='55'>Blue Dart Surface</option>
    <option value='56'>DHL Express International</option>
    <option value='57'>Professional</option>
    <option value='58'>Shadowfax Surface</option>
    <option value='60'>Ecom Express ROS</option>
    <option value='62'>FedEx Surface 1 Kg</option>
    <option value='63'>Delhivery Flash</option>
    <option value='68'>Delhivery Essential Surface</option>
    <option value='80'>Delhivery Reverse QC</option>
    <option value='95'>Shadowfax Local</option>
    <option value='96'>Shadowfax Essential Surface</option>
    <option value='97'>Dunzo Local</option>
    <option value='99'>Ecom Express ROS Reverse</option>
    <option value='100'>Delhivery Surface 10 Kgs</option>
    <option value='101'>Delhivery Surface 20 Kgs</option>
    <option value='102'>Delhivery Essential Surface 5Kg</option>
    <option value='103'>Xpressbees Essential Surface</option>
    <option value='104'>Delhivery Essential Surface 2Kg</option>
    <option value='106'>Wefast Local</option>
    <option value='107'>Wefast Local 5 Kg</option>
    <option value='108'>Ecom Express Essential</option>
    <option value='109'>Ecom Express ROS Essential</option>
    <option value='110'>Delhivery Essential</option>
    <option value='111'>Delhivery Non Essential</option>
  
  </select>
  
  
 </body> 
 
 
 
  
 <script type="text/javascript">
  $('#courier_id').on('change', function() {
    var optionSelected = $(this).find("option:selected");
    var courier_id = optionSelected.val();
    alert(courier_id);

    $.ajax({
        type: "post",
        url: "/shipment",
        data: {
          id: courier_id
        }
        // data: $("#examId").val()
      })
    //   .done(function() {
    //     alert('im here');
    //   });
  }); 
  </script>
  
  
