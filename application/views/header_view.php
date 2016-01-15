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
           
   if(($_SESSION['userLevel']) > 3){
        //echo $userid;
        header("location: ".base_url()."admin");
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
  <link rel="stylesheet" href="<?php echo base_url();?>js/datatables/datatables.css" type="text/css"/>
  <!---->
  <!--[if lt IE 9]>
    <script src="<?php echo base_url();?>js/ie/html5shiv.js"></script>
    <script src="<?php echo base_url();?>js/ie/respond.min.js"></script>
    <script src="<?php echo base_url();?>js/ie/excanvas.js"></script>
  <![endif]-->
  <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <!--<script src="<?php echo base_url();?>js/jquery.min.js"></script>-->
  <script type="text/javascript">
      
    //table
      var save_method; //for save method string
      var table;

$(document).ready(function() {
    //reload_table();
       //punch-in   
      $( "#punch-in" ).click(function(event) {
          $( "#punch-out" ).addClass('disabled');
           // $( "#punch-out" ).disable(true);
           //alert(this);
            //reload_table();  
           // alert("reload_table"+ reload_table());
            event.preventDefault();
            var managerID = $("#valManagerID").val();
            var managerName = $("#valManagerName").val();
            var siteName = $("#valSiteName").val();
            //var  attID = $("#valAttID").val();
            var  activityTime = $("#valTime").val();
            var  activityDate = $("#valDate").val();
            //var  activityStatus = $("#valActivityStatus").val();
            var  activityStatus = 'IN';
            var  outstationStatus = $("#outstationStatusTxt").val();
            var  latLongIn = $("#valLatLong").val();
            jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>manager/saveAttendance",
            //dataType: "JSON",
            data: {managerID: managerID, managerName: managerName, siteName: siteName, activityDate: activityDate, activityTime: activityTime, latLongIn: latLongIn, activityStatus: activityStatus, outstationStatus: outstationStatus},
            success: function (data) {
                    //table.ajax.reload(null,false);
                    console.log(data);
                    reload_table();
                    notify();
                },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert("Error: jqXHR: "+jqXHR+" | textStatus: "+textStatus+" | errorThrown: "+errorThrown);
                //reload_table();
            }
            });
     //reload_table();
        });
    //punch-out
    $( "#punch-out" ).click(function(event) {
        $( "#punch-in" ).addClass('disabled');
        event.preventDefault();
        var managerID = $("#valManagerID").val();
        var managerName = $("#valManagerName").val();
        var siteName = $("#valSiteName").val();
        //var  attID = $("#valAttID").val();
        var  activityTime = $("#valTime").val();
        var  activityDate = $("#valDate").val();
        //var  activityStatus = $("#valActivityStatus").val();
        var  activityStatus = 'OUT';
        var  outstationStatus = $("#outstationStatusTxt").val();
        var  latLongIn = $("#valLatLong").val();

        jQuery.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>manager/saveAttendance",
        //dataType: "JSON",
        data: {managerID: managerID, managerName: managerName, siteName: siteName, activityDate: activityDate, activityTime: activityTime, latLongIn: latLongIn, activityStatus: activityStatus, outstationStatus: outstationStatus},
        success: function (data) {
                //table.ajax.reload(null,false);
                console.log(data);
                reload_table();
                notify();
      },
       error: function (jqXHR, textStatus, errorThrown)
            {
                alert("Error: jqXHR: "+jqXHR+" | textStatus: "+textStatus+" | errorThrown: "+errorThrown);
                //reload_table();
            }
     });
    //reload_table();
    });
    
    table = $('#table').DataTable({ 
        
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo base_url();?>manager/ajax_list",
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ -1 ], //last column
            "orderable": false, //set not orderable
        },
        ],
        //alert($userid);
    });
    
//    $("#canceloutstation").click(function() {
//            //alert("cancel");
//             //alert($("#outstationStatusTxt").val());    
//        if($("#outstationStatusTxt").val()) != ""){
//
//           // alert($("#outstationStatusTxt").val());
//        }
//    });
   
    
    $('input,textarea').focus(function () {
        $(this).data('placeholder', $(this).attr('placeholder'))
               .attr('placeholder', '');
    }).blur(function () {
        $(this).attr('placeholder', $(this).data('placeholder'));
    });
    
    
    
 });
 
function reload_table(){
     // alert("reloaded!");
      table.ajax.reload(null,false); //reload datatable ajax 
}

function notify(){
           var div = document.getElementById('success');
            div.innerHTML += 'Data successfully submitted!';
           function f() { 
            div.innerHTML = "";
            $( "#punch-in" ).removeClass('disabled');
            $( "#punch-out" ).removeClass('disabled');
            //reset check box
            $('#outstationStatusTxt').val("");
            outstationTxt.innerHTML = '<label><input id=\"outstation\" type=\"checkbox\"><i></i> Add Notes</label>' ;
    }
    setTimeout(f, 3000);        
}



</script>

</head>
<body class="">
    