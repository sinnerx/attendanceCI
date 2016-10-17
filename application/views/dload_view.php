<?php
defined ('BASEPATH') or exit('No direct access allowed!');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?><!DOCTYPE html>
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
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.min.js" type="text/javascript"></script>
  
<script type="text/javascript">
    
$(document).ready(function() {
        
	$('form').submit(function() {
    
  		var checked_boxes = $(":checkbox:checked").length;

  		if(checked_boxes < 1){
      			alert("Please Select Files");
      			return false;
  		}else if($('#file_name').val() == ''){
      			alert("Please Enter Name");
      			return false;
  		}
  
	});
        
        $("#content img").each(function() {
        var imageCaption = $(this).attr("alt");
        if (imageCaption != '') {
        var imgWidth = $(this).width();
        var imgHeight = $(this).height();
        var position = $(this).position();
        //var positionTop = (position.top + imgHeight - 26)
        var positionTop = 0;
        $("<span class='img-caption'><em>" + imageCaption +
            "</em></span>").css({
            "position": "absolute",
            "top": positionTop + "px",
            "left": "0",
            "width": imgWidth + "px"
         }).insertAfter(this);
        }
    });
    $("#checkAll").change(function () {
        $("input:checkbox").prop('checked', $(this).prop("checked"));
    });
    $("img.lazy").lazyload({
         effect : "fadeIn"
    });
});
</script>
<style type="text/css">

li{
    list-style-type:none;
    margin-right:10px;
    margin-bottom:10px;
    float:left;
}
.container1 { position: relative; width: 160px; height: 130px; float: left; margin-left: 0px; }
.checkbox { position: absolute; bottom: 0px; right: 5px; z-index: 99;}
.submit { position: relative; }

#content {
	margin:10px 0 0 10px;
	position:relative;
	/*width:300px;*/
	
}
#content img:first-child {
	/*margin-bottom:10px;*/
}
#content span.img-caption {
    background:url(images/caption-bg.png);
    color:#FFF;
    display:block;
/*    font-size:11px;*/
    height:26px;
    
    line-height:26px;
    
}
#content span.img-caption em {
    font-style:normal;
    display:block;
    padding-left:5px;
    font-size:11px;
    font-family:"Palatino Linotype", "Book Antiqua", Palatino, serif;
    overflow: hidden;
    width: 160px;
        
}

</style>
</head>
<body class="">
    <section class="vbox">
    <header class="bg-white header header-md navbar navbar-fixed-top-xs box-shadow">
      <div class="navbar-header aside-md dk">
        <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen" data-target="#nav">
          <i class="fa fa-bars"></i>
        </a>
        <a href="../" class="navbar-brand"><img src="<?php // echo base_url();?>images/logo.png" class="m-r-sm"><?php if($userid==1){ echo "Administration Mode";}else{echo $this->download_model->getClusterLeadGroup($userid);} ?></a>
        <a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".user">
          <i class="fa fa-cog"></i>
        </a>
      </div>      
         <ul class="nav navbar-nav hidden-xs">
        <li>
            <span style="font-size:30px;padding-right: 10px; padding-top: 5px;color: #B4B9BC;">Attendance Management</span>
        </li>
        <li>
          <a onclick="return true;" href="../dashboard" target="_self" style="border-left:1px dashed #CECECE;color: #8B8B8B;letter-spacing: 1px"><span class="btn btn-success">Go to Pi1M <span class="not-connected-text"></span></span></a>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right m-n hidden-xs nav-user user">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <span class="thumb-sm avatar pull-left">
              <img src="<?php echo base_url();?>images/a0.png">
            </span>
            <?php echo $this->download_model->getFullName($userid); ?><b class="caret"></b>
          </a>
            
          <ul class="dropdown-menu animated fadeInRight">
            <span class="arrow top"></span>
            <li>
              <a href="../dashboard/user/profile">My Profile</a>
            </li>
            <li>
              <a href="../dashboard/user/changePassword">Change Password</a>
            </li>
            <li class="divider"></li>
            <li>
              <a href="../dashboard/logout">Logout</a>
            </li>
          </ul>
        </li>
      </ul>      
    </header>
    <section>
      <section class="hbox stretch">
        <!-- .aside -->
        <aside class="bg-black aside-md hidden-print" id="nav">          
          <section class="vbox">
                        <section class="w-f scrollable">
              <div class=slim-scroll data-height=auto data-disable-fade-out=true data-distance=0 data-size=10px data-railOpacity=0.2>
                <div class="clearfix wrapper dk nav-user hidden-xs">
        <div class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <span class="thumb avatar pull-left m-r">                        
              <img src="<?php echo base_url();?>images/a0.png" class="dker">
              <i class="on md b-black"></i>
            </span>
            <span class="hidden-nav-xs clear">
              <span class="block m-t-xs">
                <strong class="font-bold text-lt"><?php echo $this->download_model->getFullName($userid)?></strong> 
                <b class="caret"></b>
              </span>
              <span class="text-muted text-xs block">
                  <?php if($userLevel==99){ 
                    echo "Administration Mode";
                    }else if($userLevel == 3 ){ 
                        echo "Cluster Lead"; 
                    }else if($userLevel == 4 ){ 
                        echo "Operation Manager"; 
                    }else{
                       echo $this->download_model->getClusterName($userid);
                    } ?></span>
            </span>
          </a>
          <ul class="dropdown-menu animated fadeInRight m-t-xs">
            <span class="arrow top hidden-nav-xs"></span>
            <li>
              <a href="../dashboard/user/profile">My Profile</a>
            </li>
            <li>
              <a href="../dashboard/user/changePassword">Change Password</a>
            </li>
            <li class="divider"></li>
            <li>
              <a href="../dashboard/logout">Logout</a>
            </li>
          </ul>
        </div>
      </div>                
                <!-- nav -->                 
                <nav class="nav-primary hidden-xs">
                  <ul class="nav nav-main" data-ride="collapse">                
                    <li class='active'><a href="javascript:void(0);" class="auto">
                        <span class="pull-right text-muted">
                          <i class="i i-circle-sm-o text"></i>
                          <i class="i i-circle-sm text-active"></i>
                        </span>
                        <i class="i i-stack icon">
                        </i>
                        <span class="font-bold">Attendance</span>
                      </a><ul class='nav dk'>
                           <?php if($userLevel == 3){ ?>
                          <li >
                          <a href="./" class="auto">                                                        
                            <i class="i i-dot"></i>
                            <span>Punch IN/OUT</span>
                          </a>
                        </li> <?php } ?>
                         <?php if($userLevel == 4){ ?>
                        <li class=''>
                          <a href="./opmanager" class="auto">                                                        
                            <i class="i i-dot"></i>
                            <span>View Log</span>
                          </a>
                        </li><?php } ?>
                        <?php if($userLevel == 99){ ?>
                        <li class=''>
                          <a href="./admin" class="auto">                                                        
                            <i class="i i-dot"></i>
                            <span>View Log</span>
                          </a>
                        </li><?php } ?>
                        <li class='active'>
                          <a href="./download" class="auto">                                                        
                            <i class="i i-dot"></i>
                            <span>Download</span>
                          </a>
                        </li>
                        <?php if($userLevel == 99){ ?>
                        <li class=''>
                          <a href="#" class="auto" target="_blank">                                                        
                            <i class="i i-dot"></i>
                            <span>Email / Cron Simulation</span>
                          </a>
                        </li>
                        <li class=''>
                          <a href="./reporting" class="auto">                                                        
                            <i class="i i-dot"></i>
                            <span>View Report</span>
                          </a>
                        </li>    
                        <?php } ?>                        
                      </ul>
                    </li>
                  </ul> 
                </nav>
                <!-- / nav -->
              </div>
            </section>
            
            <footer class="footer hidden-xs no-padder text-center-nav-xs">
              <!--<a href="modal.lockme.html" data-toggle="ajaxModal" class="btn btn-icon icon-muted btn-inactive pull-right m-l-xs m-r-xs hidden-nav-xs">
                <i class="i i-logout"></i>
              </a>-->
              <a href="#nav" data-toggle="class:nav-xs" class="btn btn-icon icon-muted btn-inactive m-l-xs m-r-xs">
                <i class="i i-circleleft text"></i>
                <i class="i i-circleright text-active"></i>
              </a>
            </footer>
          </section>
        </aside>
        <!-- /.aside -->
        <section id="content">
          <section class="hbox stretch">
            <section>
              <section class="vbox">
                <section class="scrollable padder">              
                  <section class="row m-b-md">
                    <div class="col-sm-6">
                      <h3 class="m-b-xs text-black"><?php echo $this->download_model->getClusterLeadGroup($userid); ?> Attendance List</h3>
                      <!--<div class="well well-sm">All about your profile. You can edit all through here.</div>-->
                       <small>Welcome back, <?php echo $this->download_model->getFullName($userid)?>, <?php echo $this->download_model->getClusterLeadGroup($userid); ?><!--<i class="fa fa-map-marker fa-lg text-primary"></i>--> </small>
                    </div>
                  </section>
                    
                    <section class="scrollable wrapper">
                    <div class='row'>
                      <div class="col-md-12">
                      <section class="panel b-a">
                        <div class="panel-heading b-b">
                          <a href="#" class="font-bold">Download Daily Attendance Images</a>
                        </div><br>
                            <form name="dlform" action="download/download_zip" method="post">

                            <!-- <select>
                              <option value="">All Zone</option>
                              <option value="">West Malaysia Cluster</option>
                              <option value="">East Malaysia Cluster</option>
                            </select> 
                            <select><option value="volvo">All Cluster</option></select>
                            <select><option value="volvo">All Site</option></select>
                            <select><option value="volvo">All Manager</option></select>
                            <input type="date" name="" id="" placeholder=" Pick Date">


                            <input type="text" name="zone" id="" placeholder=" All Site">
                            <input type="text" name="zone" id="" placeholder=" All Manager">-->
                            <!--<div class="checkbox i-checks"><label><input checked="" type="checkbox"><i></i> Remember me</label></div>-->
<!--                            <div class="checkbox i-checks"><label><input type="checkbox" id="checkAll"><i></i> Check all</label></div>-->
                           

<!--                                <div class="col-md-4"><input class="form-control" type="text" name="file_name" id="file_name" placeholder=" Please name your file"></div>
                                <input type="submit" class="btn btn-sm btn-default" value="Download" id="download">&nbsp;&nbsp;&nbsp;&nbsp;
                                <label><input type="checkbox" id="checkAll"><i></i> Check all</label>
                                <div class="checkbox-inline i-checks"><label><input type="checkbox" id="checkAll"><i></i> Check all</label></div>
                                    
                                <br>-->
                                </section>  
                      </div>
                    </div>
                            <?php
//                            foreach($files as $key=>$file_name){
//                                //display table-like
//                                //echo "<tr><td><input type='checkbox' name='files[]' value='".$file_name."' /></td><td>".$file_name."</td><td>$file_name</td></tr>";
//                                //echo "<li><input type='checkbox' name='files[]' value='".$file_name."' /></li>";
//                                 
//                               // echo "<tr><td><input type='checkbox' name='files[]' value='".$file_name."' /></td><td>".$file_name."</td><td><img src=\"images/attendance/$file_name.\" alt=\"Smiley face\" height=\"42\" width=\"42\"></td></tr>";
//                                 //echo "<li><input type='checkbox' name='files[]' value='".$file_name."' />".$file_name."<a href='images/attendance/".$file_name."'><img src=\"images/attendance/$file_name.\"alt='' height=\"42\" width=\"42\" /></a></li>";
//                                 //echo "<div id='content' class='container1'><li><input type='checkbox' class='checkbox' name='files[]' value='".$file_name."' /><a href='images/attendance/".$file_name."'><img class='lazy' data-original='images/attendance/".$file_name."' alt='".$file_name."' height='130' width='160' /></a></li></div>";                             
//                                 //echo "<div id='content' class='container1'><li><input type='checkbox' class='checkbox' name='files[]' value='".$file_name."' /><a href='images/attendance/".$file_name."'><img src='images/attendance/".$file_name."' alt='".$file_name."' height='130' width='160' /></a></li></div>"; 
//
//                            }
//                            ?>


                            </form>
                      
                    </section>
<!--<script src="<?php echo base_url();?>js/jquery.min.js"></script>-->
  <!-- Bootstrap -->
  <script src="<?php echo base_url();?>js/bootstrap.js"></script>
  <!-- App -->
  <script src="<?php echo base_url();?>js/app.js"></script>  
  <script src="<?php echo base_url();?>js/slimscroll/jquery.slimscroll.min.js"></script>
  <!-- datatables -->
  <script src="<?php echo base_url();?>js/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url();?>js/datatables/dataTables.bootstrap.js"></script>
  <script src="<?php echo base_url();?>js/datatables/jquery.csv-0.71.min.js"></script>
  <script src="<?php echo base_url();?>js/calendar/bootstrap_calendar.js"></script>
  <!--<script src="<?php echo base_url();?>js/calendar/demo.js"></script>-->
  <!-- gmaps -->
  <script src="https://maps.google.com/maps/api/js?sensor=false"></script>
  <script src="<?php echo base_url();?>js/maps/gmaps.js"></script>
  <script src="<?php echo base_url();?>js/maps/demo.js"></script>
  <script src="<?php echo base_url();?>js/sortable/jquery.sortable.js"></script>
  <script src="<?php echo base_url();?>js/app.plugin.js"></script>
  <script src="<?php echo base_url('js/datatables/buttons.flash.min.js')?>"></script>
  <script src="<?php echo base_url('js/datatables/buttons.html5.min.js')?>"></script>
  <script src="<?php echo base_url('js/datatables/buttons.print.min.js')?>"></script>
  <script src="<?php echo base_url('js/datatables/dataTables.buttons.min.js')?>"></script>
  <script src="<?php echo base_url('js/datatables/jszip.min.js')?>"></script>
  <script src="<?php echo base_url('js/datatables/pdfmake.min.js')?>"></script>
  <script src="<?php echo base_url('js/datatables/vfs_fonts.js')?>"></script>  
  <!-- punch 
  <script src="<?php echo base_url();?>js/punch.js"></script>
  <!-- geolocation 
  <script src="<?php echo base_url();?>js/geolocation/geolocation.js"></script>-->
  
</body>
</html>
