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
  <!---->
  <!--[if lt IE 9]>
    <script src="<?php echo base_url();?>js/ie/html5shiv.js"></script>
    <script src="<?php echo base_url();?>js/ie/respond.min.js"></script>
    <script src="<?php echo base_url();?>js/ie/excanvas.js"></script>
  <![endif]-->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
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
      $( "#punch-in" ).click(function(event) {
          $( "#snap" ).click();
          $( "#punch-in" ).hide();
          $( "#punch-out" ).show();
          $( "#punch-out" ).addClass('disabled');
            event.preventDefault();
            var clusterID = $("#valClusterID").val();
            var managerID = $("#valManagerID").val();
            var managerName = $("#valManagerName").val();
            var siteID = $("#valSiteID").val();
            var siteName = $("#valSiteName").val();
            var userEmail = $("#valUserEmail").val();
            var activityTime = "<?php echo date("G:i"); ?>";
            var activityDate = "<?php echo date("d-m-Y");?>";
            var activityDateTime = "<?php echo date("Y-m-d G:i:s");?>";
            var  activityStatus = punchStatus = 'IN';
            var  outstationStatus = $("#outstationStatusTxt").val();
            var  latLongIn = $("#valLatLong").val();
            var  accuracy = $("#valAccuracy").val();
            var  imgIn = 'images/attendance/noimage.jpg';
            jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>manager/saveAttendance",
            //dataType: "JSON",
            data: {managerID: managerID, clusterID: clusterID, managerName: managerName, siteID: siteID, siteName: siteName, userEmail: userEmail, activityDate: activityDate, activityTime: activityTime, activityDateTime: activityDateTime, latLongIn: latLongIn, accuracy: accuracy, activityStatus: activityStatus, outstationStatus: outstationStatus, imgIn: imgIn},
            success: function (data) {
                    //table.ajax.reload(null,false);
                    console.log(data);
                    //reload_table();
                    notify();
                    $("#upload").click();

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
        $( "#punch-out" ).hide();
        $( "#punch-in" ).show();
        $( "#punch-in" ).addClass('disabled');
        event.preventDefault();
        var clusterID = $("#valClusterID").val();
        var managerID = $("#valManagerID").val();
        var managerName = $("#valManagerName").val();
        var siteID = $("#valSiteID").val();
        var siteName = $("#valSiteName").val();
        var userEmail = $("#valUserEmail").val();
        var activityTime = "<?php echo date("G:i"); ?>";
        var activityDate = "<?php echo date("d-m-Y");?>";
        var activityDateTime = "<?php echo date("Y-m-d G:i:s");?>";
        var  activityStatus = punchStatus = 'OUT';
        var  outstationStatus = $("#outstationStatusTxt").val();
        var  latLongIn = $("#valLatLong").val();
        var  accuracy = $("#valAccuracy").val();
        var  imgIn = 'images/attendance/noimage.jpg';

        jQuery.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>manager/saveAttendance",
        //dataType: "JSON",
        data: {managerID: managerID, clusterID: clusterID, managerName: managerName, siteID: siteID, siteName: siteName, userEmail: userEmail, activityDate: activityDate, activityTime: activityTime, activityDateTime: activityDateTime, latLongIn: latLongIn, accuracy: accuracy, activityStatus: activityStatus, outstationStatus: outstationStatus, imgIn: imgIn},
        success: function (data) {
                //table.ajax.reload(null,false);
                console.log(data);
                //reload_table();
                notify();
                $("#upload").click();
                //alert();

        },
        error: function (jqXHR, textStatus, errorThrown)
            {
                alert("Error: jqXHR: "+jqXHR+" | textStatus: "+textStatus+" | errorThrown: "+errorThrown);
                //reload_table();
            }
     });
    //reload_table();
    });

    
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
            div.innerHTML = "";     
            $( "#punch-in" ).removeClass('disabled');
            //}
            $( "#punch-out" ).removeClass('disabled');
            //reset check box
            $('#outstationStatusTxt').val("");
            $('#outstationspan').text(" Add Notes");
            $('#outstation').prop('checked', false);
            $("#reset").click();
            $("#uploading").hide();
            $("#uploaded").hide();
    }
    setTimeout(f, 3000);        
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
    