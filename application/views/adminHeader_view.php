<?php
defined ('BASEPATH') or exit('No direct access allowed!');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?><!DOCTYPE html>
<html lang="en" class="app">
<?php
    if (!isset($_SESSION['userid'])) {

            header("location: ../dashboard");
            //header('location:'.base_url().'dashboard');
    }
    if($_SESSION['userLevel'] < 4){
        //echo $userLevel;
       header("location: ./");
       //echo $userid;
        //if ($_SERVER['PHP_SELF'] != "") header("Location: admin/");
        //echo "Admin is here";
   }
   
?>
<head>  
  <meta charset="utf-8" />
  <title><?php echo $title ?> | <?php echo base_url();?></title>
  <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
  <link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo base_url();?>css/animate.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo base_url();?>css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo base_url();?>css/icon.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo base_url();?>css/font.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo base_url();?>css/app.css" type="text/css" />  
  <link rel="stylesheet" href="<?php echo base_url();?>js/calendar/bootstrap_calendar.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo base_url();?>js/datatables/dataTables.bootstrap.css" type="text/css"/>

  <!--<link rel="stylesheet" href="<?php echo base_url();?>js/datatables/datatables.css" type="text/css"/>
  -->
  <!--[if lt IE 9]>
    <script src="<?php echo base_url();?>js/ie/html5shiv.js"></script>
    <script src="<?php echo base_url();?>js/ie/respond.min.js"></script>
    <script src="<?php echo base_url();?>js/ie/excanvas.js"></script>
  <![endif]-->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>-->
  <!--<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>-->
  <!--<script src="<?php echo base_url();?>js/jquery.min.js"></script>-->
  <script type="text/javascript">
      
    //table
      //var save_method; //for save method string
      //var table;

        var toDisplayName;
        var toDisplayCluster;
        var toDisplayDate;
        var toDisplayTime;
        var toDisplayActivities;
        var toDisplayStatus;
        var toDisplayLatLong;
        var toDisplayImgIn;
        
$(document).ready(function() {
   
     var table = $('#tableAdmin').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo base_url();?>admin/ajax_list",
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [{ 
            "targets": [ -1, -2 ], //last column
            "orderable": false //set not orderable
        },
         {
           "targets": -2,
           "data": null,
           "defaultContent": "<a href=\"#locateMap\" class=\"btn btn-default btn-xs\" data-toggle=\"modal\"><i class=\"fa fa-map-marker\"></i> Locate!</a>"
            
        },
         {
           "targets": -1,
           "data": null,
           "defaultContent": "<a href=\"#seeImg\" class=\"btn btn-default btn-xs\" data-toggle=\"modal\"><i class=\"fa fa-eye\"></i></a>"
            
        }
        ]
    });
     $('#tableAdmin tbody').on( 'click', 'a', function () {
        var data = table.row( $(this).parents('tr') ).data();
        //alert( data[0] +"'s lat,long is: "+ data[ 6 ] );
        //$("#locateMap").modal();
        //alert(data[6]);
        toDisplayName = data[0];
        toDisplayCluster = data[1];
        toDisplayDate = data[2];
        toDisplayTime = data[3];
        toDisplayActivities = data[4];
        toDisplayStatus = data[5];
        toDisplayLatLong = data[6];
        toDisplayImgIn = data[7];
        displayMap();
        displayImg();
    } );
 });
 
 function displayMap(){
    console.log(toDisplayLatLong);
    //var  str_array = toDisplayLatLong;
    var str_array = toDisplayLatLong.split(',');
    for(var i = 0; i < str_array.length; i++) {
       // Trim the excess whitespace.
       //str_array[i] = str_array[i].replace(/^\s*/, "").replace(/\s*$/, "");/\x{00B0}/
       //clean up empty spaces and degree symbol (old records)
       str_array[i] = str_array[i].replace(/^\s*/, "").replace(/\s*$/, "").replace(/°/,"");
       // Add additional code
      // alert(str_array[i]);
    }
    console.log(toDisplayLatLong+" | "+str_array[0]+","+str_array[1]);
    var displayLat = str_array[0];
    var displayLong = str_array[1];
    var pos = new google.maps.LatLng(displayLat, displayLong);
    var options = {
            //zoom low - furthest | high - closest
            zoom: 14,
            center: pos,
            //mapTypeId: google.maps.MapTypeId.ROADMAP
            //styler for map
            styles: [{"stylers":[{"hue":"#ff1a00"},{"invert_lightness":true},{"saturation":-100},{"lightness":33},{"gamma":0.5}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#2D333C"}]}]
    };
    var map = new google.maps.Map(document.getElementById("map"), options);
    var marker = new google.maps.Marker({
            position: pos,
            map: map,
            title: "User location"
    });
    var contentString = "<br/><b>Geolocation:</b> " + displayLat +", "+ displayLong + "<br/>";
    var infowindow = new google.maps.InfoWindow({
            content: contentString
    });
    google.maps.event.addListener(marker, 'click', function() {
            infowindow.open(map,marker);
    });
    //pass value to html/canvas
    //var latitude  = position.coords.latitude;
    //var longitude = position.coords.longitude;
            
    google.maps.event.addDomListener(window, 'load', displayMap);
    
    google.maps.event.addDomListener(window, "resize", resizingMap);

    $('#locateMap').on('show.bs.modal', function() {
       //Must wait until the render of the modal appear, thats why we use the resizeMap and NOT resizingMap!! ;-)
       resizeMap();
    });

    function resizeMap() {
       if(typeof map == "undefined") return;
       setTimeout( function(){
           resizingMap();
       } , 400);
    }

    function resizingMap() {
       if(typeof map == "undefined") return;
       var center = map.getCenter();
       google.maps.event.trigger(map, "resize");
       map.setCenter(center); 
       displayMap();
    }
 }
 
function displayImg(){
  //img exist
  $("#imgView").attr('src', toDisplayImgIn);
  //}
  //img dont exist
  if(toDisplayImgIn.length === 0){
      $("#imgView").attr('src', 'images/camera-376.png');
  }
}
/*
function reload_table(){
     // alert("reloaded!");
      table.ajax.reload(null,false); //reload datatable ajax 
}

function notify(){
   
        var div = document.getElementById('success');
        div.innerHTML += 'Data successfully submitted!';
        function f() { 
            div.innerHTML = "";
    }
    setTimeout(f, 3000);        
}*/
    

</script>

</head>
<body class="">
    