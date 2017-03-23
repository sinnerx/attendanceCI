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
   if( ($_SESSION['userLevel']) != 7){
    if(($_SESSION['userLevel']) > 4 ){
            //echo $userid;
            header("location: ".base_url()."admin?".($_SESSION['userLevel']));
            //if ($_SERVER['PHP_SELF'] != "") header("Location: admin/");
            //echo "Admin is here";
       }     
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
  <link rel="stylesheet" href="<?php echo base_url();?>js/TimePicki/css/timepicki.css" type="text/css"/>
  <!-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css"> -->
  <link rel="stylesheet" href="<?php echo base_url();?>css/jquery-ui.min.css">
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
  
  <!-- datatables -->
  <script src="<?php echo base_url();?>js/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url();?>js/datatables/dataTables.bootstrap.js"></script>
  <script src="<?php echo base_url();?>js/datatables/jquery.csv-0.71.min.js"></script>
  <script src="<?php echo base_url();?>js/TimePicki/js/timepicki.js"></script>
  <!-- <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script> -->
  <script src="<?php echo base_url();?>js/jquery-ui.min.js"></script>

</head>
<body class="" >
    