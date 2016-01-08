<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
  <section class="vbox">
    <header class="bg-white header header-md navbar navbar-fixed-top-xs box-shadow">
      <div class="navbar-header aside-md dk">
        <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen" data-target="#nav">
          <i class="fa fa-bars"></i>
        </a>
        <a href="../" class="navbar-brand"><img src="<?php echo base_url();?>images/logo.png" class="m-r-sm"><?php if($userid==1){ echo "Administration Mode";}else{echo $this->manager_model->getClusterName($userid);} ?></a>
        <a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".user">
          <i class="fa fa-cog"></i>
        </a>
      </div>      
        
      <ul class="nav navbar-nav navbar-right m-n hidden-xs nav-user user">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <span class="thumb-sm avatar pull-left">
              <img src="<?php echo base_url();?>images/a0.png">
            </span>
            <?php echo $this->manager_model->getFullName($userid); ?><b class="caret"></b>
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
                <strong class="font-bold text-lt"><?php echo $this->manager_model->getFullName($userid)?></strong> 
                <b class="caret"></b>
              </span>
              <span class="text-muted text-xs block"><?php if($userLevel==2){echo "Site Manager";}else{echo "Root Admin";} ?></span>
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
                  <!--<div class="text-muted text-sm hidden-nav-xs padder m-t-sm m-b-sm">Start</div>-->
                  <ul class="nav nav-main" data-ride="collapse">
                    <li>
                      <a href="../dashboard/site/overview/" class="auto">
                        <i class="i i-statistics icon">
                        </i>
                        <span class="font-bold">Overview</span>
                      </a>
                    </li>
                    <li >
                      <a href="#" class="auto">
                        <span class="pull-right text-muted">
                          <i class="i i-circle-sm-o text"></i>
                          <i class="i i-circle-sm text-active"></i>
                        </span>
                        <!--<b class="badge bg-danger pull-right">4</b>-->
                        <i class="i i-stack icon">
                        </i>
                        <span class="font-bold">Site Management</span>
                      </a>
                      <ul class="nav dk">
                        <li >
                          <a href="../dashboard/site/edit" class="auto">                                                        
                            <i class="i i-dot"></i>

                            <span>Information</span>
                          </a>
                        </li>
                        <li >
                          <a href="../dashboard/site/slider" class="auto">                                                        
                            <i class="i i-dot"></i>

                            <span>Slider</span>
                          </a>
                        </li>
                        <li >
                          <a href="../dashboard/facebook/checkPageId" class="auto">                                                        
                            <i class="i i-dot"></i>

                            <span>Facebook</span>
                          </a>
                        </li>
                        <li >
                          <a href="../dashboard/site/announcement" class="auto">                                                        
                            <i class="i i-dot"></i>

                            <span>Announcement</span>
                          </a>
                        </li>
                        <li >
                          <a href="../dashboard/menu/index" class="auto">                                                        
                            <i class="i i-dot"></i>

                            <span>Site Menu</span>
                          </a>
                        </li>
                        <li >
                          <a href="../dashboard/sales/add" class="auto">                                                        
                            <i class="i i-dot"></i>

                            <span>Sales</span>
                          </a>
                        </li>
                        <li >
                          <a href="../dashboard/site/message" class="auto">                                                        
                            <i class="i i-dot"></i>

                            <span>Message</span>
                          </a>
                        </li>
                        
                      </ul>
                    </li>
                    <li>
                        <a href="#" class="auto">
                        <span class="pull-right text-muted">
                          <i class="i i-circle-sm-o text"></i>
                          <i class="i i-circle-sm text-active"></i>
                        </span>
                        <!--<b class="badge bg-danger pull-right">4</b>-->
                        <i class="i i-stack icon">
                        </i>
                        <span class="font-bold">Newsletter</span>
                      </a>
                        <ul class="nav dk">
                          <li >
                          <a href="../dashboard/newsletter/push" class="auto">                                                        
                            <i class="i i-dot"></i>

                            <span>Push</span>
                          </a>
                        </li>
                        <li >
                          <a href="../dashboard/newsletter/template" class="auto">                                                        
                            <i class="i i-dot"></i>

                            <span>Template</span>
                          </a>
                        </li>
                        <li >
                          <a href="../dashboard/newsletter/subscribers" class="auto">                                                        
                            <i class="i i-dot"></i>

                            <span>Subscribers</span>
                          </a>
                        </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="auto">
                        <span class="pull-right text-muted">
                          <i class="i i-circle-sm-o text"></i>
                          <i class="i i-circle-sm text-active"></i>
                        </span>
                        <!--<b class="badge bg-danger pull-right">4</b>-->
                        <i class="i i-stack icon">
                        </i>
                        <span class="font-bold">Billing</span>
                      </a>
                        <ul class="nav dk">
                          <li >
                          <a href="http://localhost/cafe" class="auto">                                                        
                            <i class="i i-dot"></i>

                            <span>Local Billing</span>
                          </a>
                        </li>
                        <li >
                          <a href="../dashboard/billing/dailyCashProcess" class="auto">                                                        
                            <i class="i i-dot"></i>

                            <span>Daily Cash Process</span>
                          </a>
                        </li>
                        <li >
                          <a href="../dashboard/billing/dailyJournal" class="auto">                                                        
                            <i class="i i-dot"></i>

                            <span>Daily Journal</span>
                          </a>
                        </li>
                        <li >
                          <a href="../dashboard/billing/transactionJournal" class="auto">                                                        
                            <i class="i i-dot"></i>

                            <span>Transaction Journal</span>
                          </a>
                        </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="auto">
                        <span class="pull-right text-muted">
                          <i class="i i-circle-sm-o text"></i>
                          <i class="i i-circle-sm text-active"></i>
                        </span>
                        <!--<b class="badge bg-danger pull-right">4</b>-->
                        <i class="i i-stack icon">
                        </i>
                        <span class="font-bold">PI1M Expense</span>
                      </a>
                        <ul class="nav dk">
                          <li >
                          <a href="../dashboard/expense/listStatus" class="auto">                                                        
                            <i class="i i-dot"></i>

                            <span>List of PR</span>
                          </a>
                        </li>
                        <li >
                          <a href="../dashboard/expense/listStatusRL" class="auto">                                                        
                            <i class="i i-dot"></i>

                            <span>List of RL</span>
                          </a>
                        </li>
                        <li >
                          <a href="../dashboard/expense/add" class="auto">                                                        
                            <i class="i i-dot"></i>

                            <span>Purchase Requisition</span>
                          </a>
                        </li>
                        
                        </ul>
                    </li>
                    <li>
                      <a href="../dashboard/page/index" class="auto">
                        <i class="i i-statistics icon">
                        </i>
                        <span class="font-bold">Pages</span>
                      </a>
                    </li>
                   <li>
                        <a href="#" class="auto">
                        <span class="pull-right text-muted">
                          <i class="i i-circle-sm-o text"></i>
                          <i class="i i-circle-sm text-active"></i>
                        </span>
                        <!--<b class="badge bg-danger pull-right">4</b>-->
                        <i class="i i-stack icon">
                        </i>
                        <span class="font-bold">Blog</span>
                      </a>
                        <ul class="nav dk">
                          <li >
                          <a href="../dashboard/site/article" class="auto">                                                        
                            <i class="i i-dot"></i>

                            <span>List of Articles</span>
                          </a>
                        </li>
                        <li >
                          <a href="../dashboard/site/addArticle" class="auto">                                                        
                            <i class="i i-dot"></i>

                            <span>Add Article</span>
                          </a>
                        </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="auto">
                        <span class="pull-right text-muted">
                          <i class="i i-circle-sm-o text"></i>
                          <i class="i i-circle-sm text-active"></i>
                        </span>
                        <!--<b class="badge bg-danger pull-right">4</b>-->
                        <i class="i i-stack icon">
                        </i>
                        <span class="font-bold">Albums</span>
                      </a>
                        <ul class="nav dk">
                          <li >
                          <a href="../dashboard/image/album" class="auto">                                                        
                            <i class="i i-dot"></i>

                            <span>Overview</span>
                          </a>
                        </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="auto">
                        <span class="pull-right text-muted">
                          <i class="i i-circle-sm-o text"></i>
                          <i class="i i-circle-sm text-active"></i>
                        </span>
                        <!--<b class="badge bg-danger pull-right">4</b>-->
                        <i class="i i-stack icon">
                        </i>
                        <span class="font-bold">Video Gallery</span>
                      </a>
                        <ul class="nav dk">
                          <li >
                          <a href="../dashboard/video/album" class="auto">                                                        
                            <i class="i i-dot"></i>

                            <span>Overview</span>
                          </a>
                        </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="auto">
                        <span class="pull-right text-muted">
                          <i class="i i-circle-sm-o text"></i>
                          <i class="i i-circle-sm text-active"></i>
                        </span>
                        <!--<b class="badge bg-danger pull-right">4</b>-->
                        <i class="i i-stack icon">
                        </i>
                        <span class="font-bold">Activities</span>
                      </a>
                        <ul class="nav dk">
                          <li >
                          <a href="../dashboard/activity/overview" class="auto">                                                        
                            <i class="i i-dot"></i>

                            <span>Overview</span>
                          </a>
                        </li>
                         <li >
                          <a href="../dashboard/activity/event" class="auto">                                                        
                            <i class="i i-dot"></i>

                            <span>Events</span>
                          </a>
                        </li>
                         <li >
                          <a href="../dashboard/activity/training" class="auto">                                                        
                            <i class="i i-dot"></i>

                            <span>Training</span>
                          </a>
                        </li>
                         <li >
                          <a href="../dashboard/activity/other" class="auto">                                                        
                            <i class="i i-dot"></i>

                            <span>Others</span>
                          </a>
                        </li>
                         <li >
                          <a href="../dashboard/activity/rsvp" class="auto">                                                        
                            <i class="i i-dot"></i>

                            <span>RSVP</span>
                          </a>
                        </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="auto">
                        <span class="pull-right text-muted">
                          <i class="i i-circle-sm-o text"></i>
                          <i class="i i-circle-sm text-active"></i>
                        </span>
                        <!--<b class="badge bg-danger pull-right">4</b>-->
                        <i class="i i-stack icon">
                        </i>
                        <span class="font-bold">Forum</span>
                      </a>
                        <ul class="nav dk">
                          <li >
                          <a href="../dashboard/forum/index" class="auto">                                                        
                            <i class="i i-dot"></i>

                            <span>Forum Management</span>
                          </a>
                        </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="auto">
                        <span class="pull-right text-muted">
                          <i class="i i-circle-sm-o text"></i>
                          <i class="i i-circle-sm text-active"></i>
                        </span>
                        <!--<b class="badge bg-danger pull-right">4</b>-->
                        <i class="i i-stack icon">
                        </i>
                        <span class="font-bold">File Manager</span>
                      </a>
                        <ul class="nav dk">
                          <li >
                          <a href="../dashboard/file/index" class="auto">                                                        
                            <i class="i i-dot"></i>

                            <span>File Manager</span>
                          </a>
                        </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="auto">
                        <span class="pull-right text-muted">
                          <i class="i i-circle-sm-o text"></i>
                          <i class="i i-circle-sm text-active"></i>
                        </span>
                        <!--<b class="badge bg-danger pull-right">4</b>-->
                        <i class="i i-stack icon">
                        </i>
                        <span class="font-bold">Member's Management</span>
                      </a>
                        <ul class="nav dk">
                          <li >
                          <a href="../dashboard/member/lists" class="auto">                                                        
                            <i class="i i-dot"></i>

                            <span>List of Member</span>
                          </a>
                        </li>
                        <li >
                          <a href="../dashboard/member/changePassword" class="auto">                                                        
                            <i class="i i-dot"></i>

                            <span>Change Member Password</span>
                          </a>
                        </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="auto">
                        <span class="pull-right text-muted">
                          <i class="i i-circle-sm-o text"></i>
                          <i class="i i-circle-sm text-active"></i>
                        </span>
                        <!--<b class="badge bg-danger pull-right">4</b>-->
                        <i class="i i-stack icon">
                        </i>
                        <span class="font-bold">Report</span>
                      </a>
                        <ul class="nav dk">
                          <li >
                          <a href="../dashboard/googleanalytics/test" class="auto">                                                        
                            <i class="i i-dot"></i>

                            <span>Google Analytics</span>
                          </a>
                        </li>
                        </ul>
                    </li>
                    <li>
                      <a href="#" class="auto">
                        <i class="i i-stack icon">
                        </i>
                        <span class="font-bold">Learning</span>
                      </a>
                    </li>
                    
                   
                    
                    
                     <?php
                        if($_SESSION['userLevel']<3){
                          ?> <!--manager menu-->
                    <li>
                      <a href="../attendance/" class="auto">
                        <i class="i i-stack icon">
                        </i>
                        <span class="font-bold">Attendance</span>
                      </a>
                    </li>
                    <!--manager menu end-->
                        <?php
                        }
                        if($_SESSION['userLevel']>98){
                          ?> <!-- admin menu -->
                    <li>
                        <a href="#" class="auto">
                        <span class="pull-right text-muted">
                          <i class="i i-circle-sm-o text"></i>
                          <i class="i i-circle-sm text-active"></i>
                        </span>
                        <!--<b class="badge bg-danger pull-right">4</b>-->
                        <i class="i i-stack icon">
                        </i>
                        <span class="font-bold">Attendance</span>
                      </a>
                        <ul class="nav dk">
                          <li >
                          <a href="./admin/" class="auto">                                                        
                            <i class="i i-dot"></i>

                            <span>View All</span>
                          </a>
                        </li>
                        </ul>
                    </li>
                    <!-- end admin menu-->
                        <?php
                        }
                        ?>
                         
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
                      <h3 class="m-b-xs text-black">Manager's Attendance</h3>
                      <!--<div class="well well-sm">All about your profile. You can edit all through here.</div>-->
                       <small>Welcome back,<?php echo $this->manager_model->getFullName($userid)?>, <?php echo $this->manager_model->getClusterName($userid); ?><!--<i class="fa fa-map-marker fa-lg text-primary"></i>--> </small>
                      
                    </div>
                  </section>
                  
<!--                 <?php //echo form_open('manager'); ?> -->
                     <?php echo form_open(); ?> 
                  <section class="panel b-a">
                  <div class="row">
                    <div class="col-md-6">
                            <div class="panel-heading b-b">
                            <p style="text-align: center"><a id="curDateTime" href="#" class="block h4 font-bold m-b text-black">Current Date/Time:<br> ...calculating</a></p>
                           <input type="hidden" value="<?php echo $userid?>" id="valManagerID">
                           <input type="hidden" value="<?php echo $this->manager_model->getFullName($userid)?>" id="valManagerName">
                           <input type="hidden" value="<?php echo $this->manager_model->getClusterName($userid); ?>" id="valSiteName">
                           <input type="hidden" value="" id="valDateTime">
                           <input type="hidden" value="" id="valDate">
                           <input type="hidden" value="" id="valTime">
                           <!--<input type="hidden" value=$userid id="valManagerID">-->
                           
                            </div>
                            <div class="r b bg-warning-ltest wrapper m-b">
                              <p style="text-align: center"><img src="<?php echo base_url();?>images/camera-512.png" height="180" width="180"></p>
                              <p style="text-align: center"> Disabled for Attendance V0.1</p>
                          </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel-heading b-b">
                            <p style="text-align: center"><a name="curLatLong" id="curLatLong" href="#" class="block h4 font-bold m-b text-black">Current Location:<br> ...calculating </a></p>                          
                         <input type="hidden" value="" id="valLatLong">
                        </div>
                            <section id="map" style="min-height:250px;"></section>
                            <div id="map"></div>
                    </div>
                  </div>
                      <div class="clearfix panel-footer"></div>
                      <div class="row">
                          <div id="outstationTxt" class="checkbox i-checks" style="text-align: center">
                              <label>
                                <input id="outstation" type="checkbox"><i></i> Add Notes
                              </label>
                            </div>
                          
                              <div id="outstationStatus" class="modal fade" tabindex="-1" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
<!--                                        <div class="modal-header">
                                            <button type="checkbox" class="close" data-dismiss="modal" id="canceloutstation_X">×</button>
                                            <h4>Outstation Status</h4>
                                        </div>-->
                                        
                                        <div class="modal-body"><h3 style="text-align: center">Attendance Note</h3>
                                            <p>
                                                <textarea name="outstationStatusTxt" id="outstationStatusTxt" rows="6" cols="75" placeholder=" Please state your reason..."></textarea>
                                            </p>
                                            <input type="hidden" value="" id="valOutStationStatus">
<!--                                        </div>
                                        <div class="modal-footer">-->
                                            <a href="#" class="btn" data-dismiss="modal" id="canceloutstation">Cancel</a>
                                            <a href="#" class="btn btn-primary" id="saveoutstation">Save</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          <div>
                          <!--<div  id='punch-in'>-->
                              <p style="text-align: center">
                                  <a id="punch-in" href="#" class="btn btn-default btn-lg" style="display: none;">
                                  <i class="fa fa-plus"></i> Punch IN</a>
                                  <input type="hidden" value="" id="valActivityStatus">
                              <!--</p>
                          </div>-->
                          
                          <!--<div  id='punch-out'>
                              <p style="text-align: center">-->
                              <a id="punch-out" href="#" class="btn btn-danger btn-lg" style="display: none;">
                                  <i class="fa fa-minus"></i> Punch OUT</a>
                              </p>
                          <!--</div>-->
                          </div><div id="success" style="text-align: center; color: green; font-weight: bold"></div>
                          <!--<div class="col-lg-offset-2 col-lg-10">-->
                          <!--<div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <i class="fa fa-ok-sign"></i><strong>Well done!</strong> You successfully read <a href="#" class="alert-link">this important alert message</a>.
                          </div>-->
                          
                          
                          
                          <!--</div>-->
                      </div>
                  </section>
                <?php echo form_close(); ?><br/>
                      
                  <div class='row'>
                    <!--<div class="col-md-4">
                      <section class="panel b-a">
                        <header class="panel-heading"><strong>Calendar</strong></header>
                        <div id="calendar" class="bg-light dker m-l-n-xxs m-r-n-xxs"></div>
                        <div class="list-group">
                          <a href="#" class="list-group-item text-ellipsis">
                            <span class="badge bg-warning">7:30</span> 
                            Soft-launch
                          </a>
                          <a href="#" class="list-group-item text-ellipsis"> 
                            <span class="badge bg-success">9:30</span> 
                            Kick off meeting with Fulkrum
                          </a>
                        </div>
                      </section>                  
                    </div>-->
                      <!-- ############ temporary disabled table
                      <div class="col-md-12">
                      <section class="panel b-a">
                        <div class="panel-heading b-b">
                         
                          <a href="#" class="font-bold">Activities</a>
                        </div>
                         <div class="table-responsive">
                              <table id="table" class="table table-striped m-b-none" data-ride="datatables">
                              
                                <thead>
                                  <tr>
                                    <th width="5%">ID</th>
                                    <th width="12%">Manager ID</th>
                                    <th width="15%">Date</th>
                                    <th width="15%">Time</th>
                                    <th width="10%">Activites</th>
                                    <th width="20%">Status</th>
                                    <th width="18%">Location (Lat, Long)</th>
                                    
                                  </tr>
                                </thead>
                                <tbody>
                                </tbody>
                              </table>
                            </div>
                      
                      ############# -->
                      
                        <!--<div class="panel-body">
                          <a href="#" class="block h4 font-bold m-b text-black">Get started with Bootstrap</a>                          
                          <div class="r b bg-warning-ltest wrapper m-b">
                            There are a few easy ways to quickly get started with Bootstrap...
                          </div>
                          <div class="m-b">
                            <a href="#" class="avatar thumb-sm">
                              <img src="../images/a0.png">
                              <i class="on b-white"></i>
                            </a>
                            <a href="#" class="avatar thumb-sm">
                              <img src="../images/a1.png">
                              <i class="busy b-white"></i>
                            </a>
                            <a href="#" class="avatar thumb-sm">
                              <img src="../images/a2.png">
                              <i class="away b-white"></i>
                            </a>
                            <a href="#" class="avatar thumb-sm">
                              <img src="../images/a3.png">
                              <i class="off b-white"></i>
                            </a>
                            <a href="#" class="btn btn-info btn-rounded font-bold">
                              +152
                            </a>
                          </div>
                          <p class="text-sm">Start at 2:00 PM, 12/5/2016</p>
                          <a href="#" class="btn btn-default btn-sm btn-rounded m-b-xs"><i class="fa fa-plus"></i> Take me in</a>
                        </div>-->
                        
                       <!--<div class="clearfix panel-footer">
                           
                        </div>--->
                      </section>
                    </div>
                  </div>
                </section>
              </section>
            </section>            
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
      </section>
    </section>
  </section>
