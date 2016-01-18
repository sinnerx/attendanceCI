<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
  <section class="vbox">
    <header class="bg-white header header-md navbar navbar-fixed-top-xs box-shadow">
      <div class="navbar-header aside-md dk">
        <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen" data-target="#nav">
          <i class="fa fa-bars"></i>
        </a>
        <a href="index.html" class="navbar-brand"><img src="<?php echo base_url();?>images/logo.png" class="m-r-sm">Scale</a>
        <a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".user">
          <i class="fa fa-cog"></i>
        </a>
      </div>      <ul class="nav navbar-nav hidden-xs">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="i i-grid"></i>
          </a>
          <section class="dropdown-menu aside-lg bg-white on animated fadeInLeft">
            <div class="row m-l-none m-r-none m-t m-b text-center">
              <div class="col-xs-4">
                <div class="padder-v">
                  <a href="#">
                    <span class="m-b-xs block">
                      <i class="i i-mail i-2x text-primary-lt"></i>
                    </span>
                    <small class="text-muted">Mailbox</small>
                  </a>
                </div>
              </div>
              <div class="col-xs-4">
                <div class="padder-v">
                  <a href="#">
                    <span class="m-b-xs block">
                      <i class="i i-calendar i-2x text-danger-lt"></i>
                    </span>
                    <small class="text-muted">Calendar</small>
                  </a>
                </div>
              </div>
              <div class="col-xs-4">
                <div class="padder-v">
                  <a href="#">
                    <span class="m-b-xs block">
                      <i class="i i-map i-2x text-success-lt"></i>
                    </span>
                    <small class="text-muted">Map</small>
                  </a>
                </div>
              </div>
              <div class="col-xs-4">
                <div class="padder-v">
                  <a href="#">
                    <span class="m-b-xs block">
                      <i class="i i-paperplane i-2x text-info-lt"></i>
                    </span>
                    <small class="text-muted">Trainning</small>
                  </a>
                </div>
              </div>
              <div class="col-xs-4">
                <div class="padder-v">
                  <a href="#">
                    <span class="m-b-xs block">
                      <i class="i i-images i-2x text-muted"></i>
                    </span>
                    <small class="text-muted">Photos</small>
                  </a>
                </div>
              </div>
              <div class="col-xs-4">
                <div class="padder-v">
                  <a href="#">
                    <span class="m-b-xs block">
                      <i class="i i-clock i-2x text-warning-lter"></i>
                    </span>
                    <small class="text-muted">Timeline</small>
                  </a>
                </div>
              </div>
            </div>
          </section>
        </li>
      </ul>
      <form class="navbar-form navbar-left input-s-lg m-t m-l-n-xs hidden-xs" role="search">
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-btn">
              <button type="submit" class="btn btn-sm bg-white b-white btn-icon"><i class="fa fa-search"></i></button>
            </span>
            <input type="text" class="form-control input-sm no-border" placeholder="Search apps, projects...">            
          </div>
        </div>
      </form>
      <ul class="nav navbar-nav navbar-right m-n hidden-xs nav-user user">
        <li class="hidden-xs">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="i i-chat3"></i>
            <span class="badge badge-sm up bg-danger count">2</span>
          </a>
          <section class="dropdown-menu aside-xl animated flipInY">
            <section class="panel bg-white">
              <header class="panel-heading b-light bg-light">
                <strong>You have <span class="count">2</span> notifications</strong>
              </header>
              <div class="list-group list-group-alt">
                <a href="#" class="media list-group-item">
                  <span class="pull-left thumb-sm">
                    <img src="<?php echo base_url();?>images/a0.png" alt="John said" class="img-circle">
                  </span>
                  <span class="media-body block m-b-none">
                    Use awesome animate.css<br>
                    <small class="text-muted">10 minutes ago</small>
                  </span>
                </a>
                <a href="#" class="media list-group-item">
                  <span class="media-body block m-b-none">
                    1.0 initial released<br>
                    <small class="text-muted">1 hour ago</small>
                  </span>
                </a>
              </div>
              <footer class="panel-footer text-sm">
                <a href="#" class="pull-right"><i class="fa fa-cog"></i></a>
                <a href="#notes" data-toggle="class:show animated fadeInRight">See all the notifications</a>
              </footer>
            </section>
          </section>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <span class="thumb-sm avatar pull-left">
              <img src="<?php echo base_url();?>images/a0.png">
            </span>
            John.Smith <b class="caret"></b>
          </a>
          <ul class="dropdown-menu animated fadeInRight">
            <span class="arrow top"></span>
            <li>
              <a href="#">Settings</a>
            </li>
            <li>
              <a href="profile.html">Profile</a>
            </li>
            <li>
              <a href="#">
                <span class="badge bg-danger pull-right">3</span>
                Notifications
              </a>
            </li>
            <li>
              <a href="docs.html">Help</a>
            </li>
            <li class="divider"></li>
            <li>
              <a href="modal.lockme.html" data-toggle="ajaxModal" >Logout</a>
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
                <strong class="font-bold text-lt">John.Smith</strong> 
                <b class="caret"></b>
              </span>
              <span class="text-muted text-xs block">Art Director</span>
            </span>
          </a>
          <ul class="dropdown-menu animated fadeInRight m-t-xs">
            <span class="arrow top hidden-nav-xs"></span>
            <li>
              <a href="#">Settings</a>
            </li>
            <li>
              <a href="profile.html">Profile</a>
            </li>
            <li>
              <a href="#">
                <span class="badge bg-danger pull-right">3</span>
                Notifications
              </a>
            </li>
            <li>
              <a href="docs.html">Help</a>
            </li>
            <li class="divider"></li>
            <li>
              <a href="modal.lockme.html" data-toggle="ajaxModal" >Logout</a>
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
                    <li>
                      <a href="../attendance/" class="auto">
                        <i class="i i-stack icon">
                        </i>
                        <span class="font-bold">Attendance</span>
                      </a>
                    </li>
                  </ul>
                </nav>
                <!-- / nav -->
              </div>
            </section>
            
            <footer class="footer hidden-xs no-padder text-center-nav-xs">
              <a href="modal.lockme.html" data-toggle="ajaxModal" class="btn btn-icon icon-muted btn-inactive pull-right m-l-xs m-r-xs hidden-nav-xs">
                <i class="i i-logout"></i>
              </a>
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
                      <h3 class="m-b-xs text-black">Cluster Lead's Dashboard <?php echo getClusterGroup ($userid); ?></h3>
                      <small>Welcome back, John Smith, <i class="fa fa-map-marker fa-lg text-primary"></i> New York City</small>
                    </div>
                    <div class="col-sm-6 text-right text-left-xs m-t-md">
                      <div class="btn-group">
                        <a class="btn btn-rounded btn-default b-2x dropdown-toggle" data-toggle="dropdown">Widgets <span class="caret"></span></a>
                        <ul class="dropdown-menu text-left pull-right">
                          <li><a href="#">Notification</a></li>
                          <li><a href="#">Messages</a></li>
                          <li><a href="#">Analysis</a></li>
                          <li class="divider"></li>
                          <li><a href="#">More settings</a></li>
                        </ul>
                      </div>
                      <a href="#" class="btn btn-icon b-2x btn-default btn-rounded hover"><i class="i i-bars3 hover-rotate"></i></a>
                      <a href="#nav, #sidebar" class="btn btn-icon b-2x btn-info btn-rounded" data-toggle="class:nav-xs, show"><i class="fa fa-bars"></i></a>
                    </div>
                  </section>
                  <!--<div class="row">
                    <div class="col-sm-6">
                      <div class="panel b-a">
                        <div class="row m-n">
                          <div class="col-md-6 b-b b-r">
                            <a href="#" class="block padder-v hover">
                              <span class="i-s i-s-2x pull-left m-r-sm">
                                <i class="i i-hexagon2 i-s-base text-danger hover-rotate"></i>
                                <i class="i i-plus2 i-1x text-white"></i>
                              </span>
                              <span class="clear">
                                <span class="h3 block m-t-xs text-danger">2,000</span>
                                <small class="text-muted text-u-c">New Visits</small>
                              </span>
                            </a>
                          </div>
                          <div class="col-md-6 b-b">
                            <a href="#" class="block padder-v hover">
                              <span class="i-s i-s-2x pull-left m-r-sm">
                                <i class="i i-hexagon2 i-s-base text-success-lt hover-rotate"></i>
                                <i class="i i-users2 i-sm text-white"></i>
                              </span>
                              <span class="clear">
                                <span class="h3 block m-t-xs text-success">75%</span>
                                <small class="text-muted text-u-c">Bounce rate</small>
                              </span>
                            </a>
                          </div>
                          <div class="col-md-6 b-b b-r">
                            <a href="#" class="block padder-v hover">
                              <span class="i-s i-s-2x pull-left m-r-sm">
                                <i class="i i-hexagon2 i-s-base text-info hover-rotate"></i>
                                <i class="i i-location i-sm text-white"></i>
                              </span>
                              <span class="clear">
                                <span class="h3 block m-t-xs text-info">25 <span class="text-sm">m</span></span>
                                <small class="text-muted text-u-c">location</small>
                              </span>
                            </a>
                          </div>
                          <div class="col-md-6 b-b">
                            <a href="#" class="block padder-v hover">
                              <span class="i-s i-s-2x pull-left m-r-sm">
                                <i class="i i-hexagon2 i-s-base text-primary hover-rotate"></i>
                                <i class="i i-alarm i-sm text-white"></i>
                              </span>
                              <span class="clear">
                                <span class="h3 block m-t-xs text-primary">9:30</span>
                                <small class="text-muted text-u-c">Meeting</small>
                              </span>
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                      <div class="panel b-a">
                        <div class="panel-heading no-border bg-primary lt text-center">
                          <a href="#">
                            <i class="fa fa-facebook fa fa-3x m-t m-b text-white"></i>
                          </a>
                        </div>
                        <div class="padder-v text-center clearfix">                            
                          <div class="col-xs-6 b-r">
                            <div class="h3 font-bold">42k</div>
                            <small class="text-muted">Friends</small>
                          </div>
                          <div class="col-xs-6">
                            <div class="h3 font-bold">90</div>
                            <small class="text-muted">Feeds</small>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                      <div class="panel b-a">
                        <div class="panel-heading no-border bg-info lter text-center">
                          <a href="#">
                            <i class="fa fa-twitter fa fa-3x m-t m-b text-white"></i>
                          </a>
                        </div>
                        <div class="padder-v text-center clearfix">                            
                          <div class="col-xs-6 b-r">
                            <div class="h3 font-bold">27k</div>
                            <small class="text-muted">Tweets</small>
                          </div>
                          <div class="col-xs-6">
                            <div class="h3 font-bold">15k</div>
                            <small class="text-muted">Followers</small>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-3 hide">
                      <section class="panel b-a">
                        <header class="panel-heading b-b b-light">
                          <ul class="nav nav-pills pull-right">
                            <li>
                              <a href="ajax.pie.html" class="text-muted" data-bjax data-target="#b-c">
                                <i class="i i-cycle"></i>
                              </a>
                            </li>
                            <li>
                              <a href="#" class="panel-toggle text-muted">
                                <i class="i i-plus text-active"></i>
                                <i class="i i-minus text"></i>
                              </a>
                            </li>
                          </ul>
                          Connection
                        </header>
                        <div class="panel-body text-center bg-light lter" id="b-c">
                          <div class="easypiechart inline m-b m-t" data-percent="60" data-line-width="4" data-bar-Color="#23aa8c" data-track-Color="#c5d1da" data-color="#2a3844" data-scale-Color="false" data-size="120" data-line-cap='butt' data-animate="2000">
                            <div>
                              <span class="h2 m-l-sm step"></span>%
                              <div class="text text-xs">completed</div>
                            </div>
                          </div>
                        </div>
                      </section>                      
                    </div>
                  </div>  -->         
                  <div class="row bg-light dk m-b">
                    <div class="col-md-6 dker">
                      <section>
                        <header class="font-bold padder-v">
                          <div class="pull-right">
                            <div class="btn-group">
                              <button data-toggle="dropdown" class="btn btn-sm btn-rounded btn-default dropdown-toggle">
                                <span class="dropdown-label">Week</span> 
                                <span class="caret"></span>
                              </button>
                              <ul class="dropdown-menu dropdown-select">
                                  <li><a href="#"><input type="radio" name="b">Month</a></li>
                                  <li><a href="#"><input type="radio" name="b">Week</a></li>
                                  <li><a href="#"><input type="radio" name="b">Day</a></li>
                              </ul>
                            </div>
                            <a href="#" class="btn btn-default btn-icon btn-rounded btn-sm">Go</a>
                          </div>
                          Statistics
                        </header>
                        <div class="panel-body">
                          <div id="flot-sp1ine" style="height:210px"></div>
                        </div>
                        <div class="row text-center no-gutter">
                          <div class="col-xs-3">
                            <span class="h4 font-bold m-t block">5,860</span>
                            <small class="text-muted m-b block">Orders</small>
                          </div>
                          <div class="col-xs-3">
                            <span class="h4 font-bold m-t block">10,450</span>
                            <small class="text-muted m-b block">Sellings</small>
                          </div>
                          <div class="col-xs-3">
                            <span class="h4 font-bold m-t block">21,230</span>
                            <small class="text-muted m-b block">Items</small>
                          </div>
                          <div class="col-xs-3">
                            <span class="h4 font-bold m-t block">7,230</span>
                            <small class="text-muted m-b block">Customers</small>                        
                          </div>
                        </div>
                      </section>
                    </div>
                    <div class="col-md-6">
                      <section>
                        <header class="font-bold padder-v">
                          <div class="btn-group pull-right">
                            <button data-toggle="dropdown" class="btn btn-sm btn-rounded btn-default dropdown-toggle">
                              <span class="dropdown-label">Last 24 Hours</span> 
                              <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-select">
                                <li><a href="#"><input type="radio" name="a">Today</a></li>
                                <li><a href="#"><input type="radio" name="a">Yesterday</a></li>
                                <li><a href="#"><input type="radio" name="a">Last 24 Hours</a></li>
                                <li><a href="#"><input type="radio" name="a">Last 7 Days</a></li>
                                <li><a href="#"><input type="radio" name="a">Last 30 days</a></li>
                                <li><a href="#"><input type="radio" name="a">Last Month</a></li>
                                <li><a href="#"><input type="radio" name="a">All Time</a></li>
                            </ul>
                          </div>
                          Analysis
                        </header>
                        <div class="panel-body flot-legend">
                          <div id="flot-pie-donut"  style="height:240px"></div>
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-8">
                      <section class="panel b-a">
                        <div class="panel-heading b-b">
                          <!--<span class="badge bg-warning pull-right">10</span>-->
                          <a href="#" class="font-bold">Recent Activities</a>
                        </div>
                        
                        <section class="panel panel-default">

                            <div class="table-responsive">
                              <table class="table table-striped m-b-none" data-ride="datatables">
                                <thead>
                                  <tr>
                                    <th width="20%">No</th>
                                    <th width="25%">Browser</th>
                                    <th width="25%">Platform(s)</th>
                                    <th width="15%">Version</th>
                                    <th width="15%">Grade</th>
                                  </tr>
                                </thead>
                                <tbody>
                                </tbody>
                              </table>
                            </div>
                        </section>
                      </section>
                    </div>
                    <div class="col-md-4">
                      <section class="panel b-light">
                        <header class="panel-heading"><strong>Calendar</strong></header>
                        <div id="calendar" class="bg-light dker m-l-n-xxs m-r-n-xxs"></div>
                        <div class="list-group">
                          <a href="#" class="list-group-item text-ellipsis">
                            <span class="badge bg-warning">7:30</span> 
                            Meet a friend
                          </a>
                          <a href="#" class="list-group-item text-ellipsis"> 
                            <span class="badge bg-success">9:30</span> 
                            Have a kick off meeting with .inc company
                          </a>
                        </div>
                      </section>                  
                    </div>
                  </div>
                  
                  </div>-->
                </section>
              </section>
            </section>
            <!-- side content -->
            <aside class="aside-md bg-black hide" id="sidebar">
              <section class="vbox animated fadeInRight">
                <section class="scrollable">
                  <div class="wrapper"><strong>Live feed</strong></div>
                  <ul class="list-group no-bg no-borders auto">
                    <li class="list-group-item">
                      <span class="fa-stack pull-left m-r-sm">
                        <i class="fa fa-circle fa-stack-2x text-success"></i>
                        <i class="fa fa-reply fa-stack-1x text-white"></i>
                      </span>
                      <span class="clear">
                        <a href="#">Goody@gmail.com</a> sent your email
                        <small class="icon-muted">13 minutes ago</small>
                      </span>
                    </li>
                    <li class="list-group-item">
                      <span class="fa-stack pull-left m-r-sm">
                        <i class="fa fa-circle fa-stack-2x text-danger"></i>
                        <i class="fa fa-file-o fa-stack-1x text-white"></i>
                      </span>
                      <span class="clear">
                        <a href="#">Mide@live.com</a> invite you to join a meeting
                        <small class="icon-muted">20 minutes ago</small>
                      </span>
                    </li>
                    <li class="list-group-item">
                      <span class="fa-stack pull-left m-r-sm">
                        <i class="fa fa-circle fa-stack-2x text-info"></i>
                        <i class="fa fa-map-marker fa-stack-1x text-white"></i>
                      </span>
                      <span class="clear">
                        <a href="#">Geoge@yahoo.com</a> is online
                        <small class="icon-muted">1 hour ago</small>
                      </span>
                    </li>
                    <li class="list-group-item">
                      <span class="fa-stack pull-left m-r-sm">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-info fa-stack-1x text-white"></i>
                      </span>
                      <span class="clear">
                        <a href="#"><strong>Admin</strong></a> post a info
                        <small class="icon-muted">1 day ago</small>
                      </span>
                    </li>
                  </ul>
                  <div class="wrapper"><strong>Friends</strong></div>
                  <ul class="list-group no-bg no-borders auto">
                    <li class="list-group-item">
                      <div class="media">
                        <span class="pull-left thumb-sm avatar">
                          <img src="<?php echo base_url();?>images/a3.png" alt="John said" class="img-circle">
                          <i class="on b-black bottom"></i>
                        </span>
                        <div class="media-body">
                          <div><a href="#">Chris Fox</a></div>
                          <small class="text-muted">about 2 minutes ago</small>
                        </div>
                      </div>
                    </li>
                    <li class="list-group-item">
                      <div class="media">
                        <span class="pull-left thumb-sm avatar">
                          <img src="<?php echo base_url();?>images/a2.png" alt="John said">
                          <i class="on b-black bottom"></i>
                        </span>
                        <div class="media-body">
                          <div><a href="#">Amanda Conlan</a></div>
                          <small class="text-muted">about 2 hours ago</small>
                        </div>
                      </div>
                    </li>
                    <li class="list-group-item">
                      <div class="media">
                        <span class="pull-left thumb-sm avatar">
                          <img src="<?php echo base_url();?>images/a1.png" alt="John said">
                          <i class="busy b-black bottom"></i>
                        </span>
                        <div class="media-body">
                          <div><a href="#">Dan Doorack</a></div>
                          <small class="text-muted">3 days ago</small>
                        </div>
                      </div>
                    </li>
                    <li class="list-group-item">
                      <div class="media">
                        <span class="pull-left thumb-sm avatar">
                          <img src="<?php echo base_url();?>images/a0.png" alt="John said">
                          <i class="away b-black bottom"></i>
                        </span>
                        <div class="media-body">
                          <div><a href="#">Lauren Taylor</a></div>
                          <small class="text-muted">about 2 minutes ago</small>
                        </div>
                      </div>
                    </li>
                  </ul>
                </section>
              </section>              
            </aside>
            <!-- / side content -->
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
      </section>
    </section>
  </section>