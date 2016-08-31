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
    if($_SESSION['userLevel'] < 5){
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
<!--   <link rel="stylesheet" href="<?php echo base_url();?>css/dropdown.css" type="text/css" />   -->
  <link rel="stylesheet" href="<?php echo base_url();?>css/jquery-ui.min.css" type="text/css" />  
  <link rel="stylesheet" href="<?php echo base_url();?>js/calendar/bootstrap_calendar.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo base_url();?>js/datatables/dataTables.bootstrap.css" type="text/css"/>
  <link rel="stylesheet" href="<?php echo base_url();?>js/datepicker/datepicker.css" type="text/css"/>
  <link rel="stylesheet" href="<?php echo base_url();?>js/datatables/buttons.dataTables.min.css" type="text/css" />

  <!--<link rel="stylesheet" href="<?php echo base_url();?>js/datatables/datatables.css" type="text/css"/>
  -->
  <!--[if lt IE 9]>
    <script src="<?php echo base_url();?>js/ie/html5shiv.js"></script>
    <script src="<?php echo base_url();?>js/ie/respond.min.js"></script>
    <script src="<?php echo base_url();?>js/ie/excanvas.js"></script>
  <![endif]-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>-->
  <!--<script src="<?php echo base_url();?>js/jquery.min.js"></script>-->
  <script src="<?php echo base_url();?>js/datepicker/bootstrap-datepicker.js"></script>
  <script src="<?php echo base_url();?>js/jquery-ui.min.js"></script>
  <script src="<?php echo base_url();?>js/app.js"></script>
  <!--<script src="<?php echo base_url();?>js/bootstrap.js"></script>-->
  <script type="text/javascript">
  $(document).ready(function() {
	$(".datepicker-input").each(function(){ $(this).datepicker();});
        
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth()+1; //January is 0!
        var yyyy = today.getFullYear();
        if(dd<10){
            dd='0'+dd;
        } 
        if(mm<10){
            mm='0'+mm;
        } 
        var today = dd+'-'+mm+'-'+yyyy;
        document.getElementById("date1").value = today;
        document.getElementById("date2").value = today;

});
 </script>
</head>

<body class="">

    