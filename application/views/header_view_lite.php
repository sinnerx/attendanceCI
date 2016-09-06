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
           
   if(($_SESSION['userLevel']) > 4){
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
  <link rel="stylesheet" href="<?php echo base_url();?>js/datatables/dataTables.bootstrap.css" type="text/css"/>
  <!--<link rel="stylesheet" href="<?php echo base_url();?>js/datatables/datatables.css" type="text/css"/>-->
  <style type="text/css">
      #cover {
          position: fixed;
          height: 100%;
          width: 100%;
          top:0; left: 0;
          background: #000;
          z-index:9999; 
          font-size: 30px;
          text-align: center;
          padding-top: 200px;
          color: #fff;}
  </style>
  <!---->
  <!--[if lt IE 9]>
    <script src="<?php echo base_url();?>js/ie/html5shiv.js"></script>
    <script src="<?php echo base_url();?>js/ie/respond.min.js"></script>
    <script src="<?php echo base_url();?>js/ie/excanvas.js"></script>
  <![endif]-->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
 <script src="<?php echo base_url();?>js/geolocation/geolocation.js"></script>
   <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>-->
  <!--<script src="<?php echo base_url();?>js/jquery.min.js"></script>-->
  <script type="text/javascript">
      
    //table
      var save_method; //for save method string
      var table;
      var punchStatus;
      var activityDateData;
      var activityTimeData;
      var canvas;
      var vidSrc;

$(document).ready(function() {
    //loadCamera();
    //reload_table();
       //punch-in   
       latestActivity("<?php echo $userid;?>");
      $( "#punch-in" ).click(function(event) {
          $( "#snap" ).click();
//          $( "#punch-in" ).hide();
//          $( "#punch-out" ).show();
//          $( "#punch-out" ).addClass('disabled');
            $(this).button('loading');
            event.preventDefault();
            var  activityStatus = punchStatus = 'IN';
            var  outstationStatus = $("#outstationStatusTxt").val();
            var  latLongIn = $("#valLatLong").val();
            var  accuracy = $("#valAccuracy").val();
            var  imgIn = 'images/attendance/noimage.jpg';
            jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>manager/saveAttendance",
            //dataType: "JSON",
            data: {latLongIn: latLongIn, accuracy: accuracy, activityStatus: activityStatus, outstationStatus: outstationStatus, imgIn: imgIn},
            success: function (data) {
                    //table.ajax.reload(null,false);
                    console.log(data);
                    //reload_table();
                    notify();
                    $("#upload").click();
                    latestActivity(data);
                },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert("Error: jqXHR: "+jqXHR+" | textStatus: "+textStatus+" | errorThrown: "+errorThrown);
            }
            });
     //reload_table();
        });
    //punch-out
    $( "#punch-out" ).click(function(event) {
        $("#snap").click();
//        $( "#punch-out" ).hide();
//        $( "#punch-in" ).show();
//        $( "#punch-in" ).addClass('disabled');
        $(this).button('loading');
        event.preventDefault();
        var  activityStatus = punchStatus = 'OUT';
        var  outstationStatus = $("#outstationStatusTxt").val();
        var  latLongIn = $("#valLatLong").val();
        var  accuracy = $("#valAccuracy").val();
        var  imgIn = 'images/attendance/noimage.jpg';

        jQuery.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>manager/saveAttendance",
        //dataType: "JSON",
        data: {latLongIn: latLongIn, accuracy: accuracy, activityStatus: activityStatus, outstationStatus: outstationStatus, imgIn: imgIn},
        success: function (data) {
                //table.ajax.reload(null,false);
                console.log(data);
                //reload_table();
                notify();
                $("#upload").click();
                latestActivity(data);

        },
        error: function (jqXHR, textStatus, errorThrown)
            {
                alert("Error: jqXHR: "+jqXHR+" | textStatus: "+textStatus+" | errorThrown: "+errorThrown);
                //reload_table();
            }
     });
    //reload_table();
    });

function latestActivity(data){
    $.ajax({                    
            type: "GET",
            url: "<?php echo base_url(); ?>manager/ajax_list",
            data: data,
            beforeSend: function(){
                $("#latestActivity").html('<i class=\'fa fa-cog fa-spin\'></i> Loading last activity\'s...');
            },
            success: function(data){
                 var data_json = JSON.parse(data).data[0];
                console.log(JSON.parse(data).data[0]);
                $("#latestActivity").html(
                        '<b>Punch:</b> '+data_json[0]+'<br>'+
                        '<b>Date:</b> '+data_json[1]+'<br>'+
                        '<b>Time:</b> '+data_json[2]+'<br>'+
                        '<b>GPS:</b> '+data_json[3]+'<br>'+
                        '<b>Notes:</b> '+data_json[4]
                        );
            }
         });
}
    
    $('input,textarea').focus(function () {
        $(this).data('placeholder', $(this).attr('placeholder'))
               .attr('placeholder', '');
    }).blur(function () {
        $(this).attr('placeholder', $(this).data('placeholder'));
    });
 });

function notify(){
    //alert("datetime: "activityDate + activityTime);
           var div = document.getElementById('success');
            div.innerHTML += 'Data successfully submitted!';
            console.log('success!!!');
            function f() { 
                $("#success").fadeOut('slow');   
                $( "#punch-in" ).removeClass('disabled');
                $( "#punch-out" ).removeClass('disabled');
                $( "#punch-in" ).button('reset');
                $( "#punch-out" ).button('reset');
                if($('#punch-in').is(':visible')) {
                    $('#punch-in').hide();
                    $('#punch-out').show();
                } else if($('#punch-out').is(':visible')){
                    $('#punch-in').show();
                    $('#punch-out').hide();
                }
                //reset check box
                $('#outstationStatusTxt').val("");
                $('#outstationspan').text(" Add Notes");
                $('#outstation').prop('checked', false);
                $("#reset").click();
                $("#uploading").hide();
                $("#uploaded").hide();
    }
    setTimeout(f, 1500);        
}
 function checkVideoID (){
      if(video.src.length !== 0){
          document.getElementById("main").style.display = "";
          document.getElementById("camImg").style.display = "none";
      } else {
          //console.log("loadingTitle: "+document.getElementById("loadingTitle").innerHTML);
          document.getElementById("loadingTitle").innerHTML = "Camera Module Temporary Disabled...please make sure:";
         // loadCamera();
      }
 }
</script>

</head>
<body class="" >
    