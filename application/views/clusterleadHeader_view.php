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
    if(!($_SESSION['userLevel'] == 3)){
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

  <!--<link rel="stylesheet" href="<?php echo base_url();?>js/datatables/datatables.css" type="text/css"/>
  -->
  <!--[if lt IE 9]>
    <script src="<?php echo base_url();?>js/ie/html5shiv.js"></script>
    <script src="<?php echo base_url();?>js/ie/respond.min.js"></script>
    <script src="<?php echo base_url();?>js/ie/excanvas.js"></script>
  <![endif]-->
  <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  
  <!--<script src="<?php echo base_url();?>js/jquery.min.js"></script>-->
  <script src="<?php echo base_url();?>js/datepicker/bootstrap-datepicker.js"></script>
  <script src="<?php echo base_url();?>js/jquery-ui.min.js"></script>

  <script type="text/javascript">
      //$('#dateFrom').datepicker();
    //table
      var save_method; //for save method string
      var table;

$(document).ready(function() {

    table = $('#tableClusterLead').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo base_url();?>clusterlead/ajax_list",
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ -1 ], //last column
            "orderable": false, //set not orderable
        },
        ],

    });

    

    //   $('#tableClusterLeadReport').DataTable({ 

    //     "processing": true, //Feature control the processing indicator.
    //     "serverSide": true, //Feature control DataTables' server-side processing mode.
    //     "order": [], //Initial no order.

    //     // Load data for the table's content from an Ajax source
    //     "ajax": {
    //         "url": "<?php echo base_url();?>reporting/ajax_list",
    //         "type": "POST"
    //     },

    //     //Set column definition initialisation properties.
    //     "columnDefs": [
    //     { 
    //         "targets": [ -1 ], //last column
    //         "orderable": false, //set not orderable
    //     },
    //     ],

    // });    
    
 });
 
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

    