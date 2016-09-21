<?php defined ('BASEPATH') or exit('No direct access allowed!'); ?>
    <section class="vbox">
    <header class="bg-white header header-md navbar navbar-fixed-top-xs box-shadow">
      <div class="navbar-header aside-md dk">
        <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen" data-target="#nav">
          <i class="fa fa-bars"></i>
        </a>
        <a href="../" class="navbar-brand"><img src="<?php echo base_url();?>images/logo.png" class="m-r-sm"><?php if($userid==1){ echo "Administration Mode";}else{echo $this->image_model->getClusterLeadGroup($userid);} ?></a>
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
            <?php echo $this->image_model->getFullName($userid); ?><b class="caret"></b>
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
                <strong class="font-bold text-lt"><?php echo $this->image_model->getFullName($userid)?></strong> 
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
                       echo $this->image_model->getClusterName($userid);
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
                        <!--<li class=''>
                          <a href="#" class="auto" target="_blank">                                                        
                            <i class="i i-dot"></i>
                            <span>Email / Cron Simulation</span>
                          </a>
                        </li>-->
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
                      <h3 class="m-b-xs text-black"><?php echo $this->image_model->getClusterLeadGroup($userid); ?> Download</h3>
                      <!--<div class="well well-sm">All about your profile. You can edit all through here.</div>-->
                       <small>Welcome back, <?php echo $this->image_model->getFullName($userid)?>, <?php echo $this->image_model->getClusterLeadGroup($userid); ?><!--<i class="fa fa-map-marker fa-lg text-primary"></i>--> </small>
                    </div>
                  </section>
                    
                    <section class="scrollable wrapper">
                    <div class='row'>
                      <div class="col-md-12">
                      <section class="panel b-a">
                        <div class="panel-heading b-b">
                          <a href="#" class="font-bold">Download Daily Attendance Images</a>
                        </div><br>
                            <form id="dlform" class="form-horizontal" name="dlform" action="<?php echo base_url();?>image/download" method="post">
                            <div class="form-group">
<!--                              <label class="col-sm-1 control-label">Select</label>-->
                              <div class="col-sm-4">
                                  <select name="selectType" id="selectType" class="form-control m-b">
                                  <option value="0">-- Select Site --</option>
                                  <option value="1">All P1M Manager</option>
                                  <option value="2">All Nusuara Staff</option>
                                  <option value="3">Region</option>
                                  <option value="4">Cluster</option>
                                  <option value="5">Pi1M Site</option>
                                  <option value="6">Manager/Staff</option>
                                </select>

                              </div>
                              <div class="col-sm-4">
                                  <select name="typelist" id="typelist" class="form-control m-b">
                                  <option>-- Select --</option>
                                </select>

                              </div>
                            </div>
                            <div class="line line-dashed b-b line-lg pull-in"></div>

                            <!--<div class="checkbox i-checks"><label><input checked="" type="checkbox"><i></i> Remember me</label></div>-->
<!--                            <div class="checkbox i-checks"><label><input type="checkbox" id="checkAll"><i></i> Check all</label></div>-->
                          
                          <div class="form-group">
                             <label class="col-sm-1 control-label">From:</label>
                              <div class="col-sm-3">
                                  <input id="date1" name="from" class="input-sm input-s datepicker-input form-control" size="16" value="" data-date-format="dd-mm-yyyy" type="text">
                              </div>
<!--                           </div>
                           <div class="form-group">-->
                             <label class="col-sm-1 control-label">Until:</label>
                              <div class="col-sm-3">
                                  <input id="date2" name="to" class="input-sm input-s datepicker-input form-control" size="16" value="" data-date-format="dd-mm-yyyy" type="text">
                              </div>
                             
                             <button id="search" type="" class="btn btn-primary center" data-loading-text="Searching... <i class='fa fa-cog fa-spin'></i>"><i class="fa fa-search"></i> Search</button>
                             <button id="download" type="submit" form="dlform" class="btn btn-success center"><i class="fa fa-download"></i> Download</button>
                            </form>

<!--                           <a type="submit" class="btn btn-danger right"><i class="fa fa-download"></i> Reset</a></div>-->
                          
                          
                                                    <div class="line line-dashed b-b line-lg pull-in"></div>
                                <div class="alert alert-info">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <i class="fa fa-info-sign"></i><strong>122548 </strong> image files are selected & ready to be download.
                              </div>
                      
                                <!-- pagination-->
                                <div id="container">
                                  <div id="body">
                                  <?php 
                                  if(!empty($att_image)){
                                      //echo sizeof($att_image);
                                  foreach($att_image as $key=>$image_name){
                                        //echo $img_name["imgIn"];
                                        $file_name = $image_name["imgIn"];
                                      echo "<img src='".base_url()."".$file_name."' alt='".$file_name."' height='130' width='160' />";                             
                                    }
                                   echo '<br>';
                                   echo $this->pagination->create_links();
                                   
                                  }
                                  ?>
                                  </div>
                                 </div> 
                                <!-- end pagination-->
                          </div>
                    </div>
                      </section>
                    </section>
                </section>
              </section>
            </section>
          </section>
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
<!--  <script src="https://maps.google.com/maps/api/js?sensor=false"></script>-->
<!--  <script src="<?php echo base_url();?>js/maps/gmaps.js"></script>-->
<!--  <script src="<?php echo base_url();?>js/maps/demo.js"></script>-->
  <script src="<?php echo base_url();?>js/sortable/jquery.sortable.js"></script>
  <script src="<?php echo base_url();?>js/app.plugin.js"></script>
  <script src="<?php echo base_url('js/datatables/buttons.flash.min.js')?>"></script>
  <script src="<?php echo base_url('js/datatables/buttons.html5.min.js')?>"></script>
  <script src="<?php echo base_url('js/datatables/buttons.print.min.js')?>"></script>
  <script src="<?php echo base_url('js/datatables/dataTables.buttons.min.js')?>"></script>
  <script src="<?php echo base_url('js/datatables/jszip.min.js')?>"></script>
  <script src="<?php echo base_url('js/datatables/pdfmake.min.js')?>"></script>
  <script src="<?php echo base_url('js/datatables/vfs_fonts.js')?>"></script>
  <script src="<?php echo base_url('js/datepicker/bootstrap-datepicker.js')?>"></script>  
  <!-- punch 
  <script src="<?php echo base_url();?>js/punch.js"></script>
  <!-- geolocation 
  <script src="<?php echo base_url();?>js/geolocation/geolocation.js"></script>-->
  
</body>
</html>
