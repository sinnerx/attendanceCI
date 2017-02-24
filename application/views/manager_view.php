<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
  <section class="vbox"><?php //if($userLevel == 3){echo "clusterid: ".$this->manager_model->getClusterLeadGroupID($userid);} else if($userLevel == 2){echo "clusterid: ".$this->manager_model->getClusterGroupID($userid);} ?>
    <header class="bg-white header header-md navbar navbar-fixed-top-xs box-shadow">
      <div class="navbar-header aside-md dk">
        <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen" data-target="#nav">
          <i class="fa fa-bars"></i>
        </a>
        <a href="../" class="navbar-brand"><img src="<?php echo base_url();?>images/logo.png" class="m-r-sm">
            
            <?php if($userLevel==99){ 
                echo "Administration Mode";
            }else if($userLevel == 3 ){ 
                echo $this->manager_model->getClusterLeadGroup($userid); 
            }else if($userLevel == 4 ){ 
                echo "Operation Manager"; 
            }else{
                 echo $this->manager_model->getClusterName($userid);
            } ?></a>
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
              <span class="text-muted text-xs block">
                  <?php if($userLevel==2 || $userLevel == 7){
                      echo "Site Manager";
                  }else if($userLevel==3){
                      echo "Cluster Lead";
                  }else if($userLevel==4){
                      echo "Operation Manager";
                  }else{
                      echo "Root Admin";
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
                    <!-- ops manager menu-->
                  <?php if($userLevel == 2 || $userLevel == 7){ ?>
                  <ul class="nav nav-main" data-ride="collapse">
                      <li class="active">
                      <a href="#" class="auto">
                        <i class="i i-statistics icon">
                        </i>
                        <span class="font-bold">Attendance</span>
                      </a>
                    </li> 
                    <!-- cluster lead menu-->
                    <?php } else if($userLevel == 3){ ?>
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
                          <li class='active'>
                          <a href="#" class="auto">                                                        
                            <i class="i i-dot"></i>
                            <span>Punch IN/OUT</span>
                          </a>
                        </li>
                        <li >
                          <a href="./clusterlead" class="auto">                                                        
                            <i class="i i-dot"></i>
                            <span>View Log</span>
                          </a>
                        </li>
                        <li class=''>
                          <a href="./reporting" class="auto">                                                        
                            <i class="i i-dot"></i>
                            <span>View Report</span>
                          </a>
                        </li>
                        
                      </ul>
                    </li>
                  </ul>
                   
                  <!-- ops manager menu-->
                  <?php } else if($userLevel == 4){ ?>
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
                          <li class='active'>
                          <a href="#" class="auto">                                                        
                            <i class="i i-dot"></i>
                            <span>Punch IN/OUT</span>
                          </a>
                        </li>
                        <li class="">
                          <a href="./opmanager" class="auto">                                                        
                            <i class="i i-dot"></i>
                            <span>View Log</span>
                          </a>
                        </li>
                        <li class=''>
                          <a href="./download" class="auto">                                                        
                            <i class="i i-dot"></i>
                            <span>Download</span>
                          </a>
                        </li>
                        <li class=''>
                          <a href="./reporting" class="auto">                                                        
                            <i class="i i-dot"></i>
                            <span>View Report</span>
                          </a>
                        </li>                        
                      </ul>
                    </li>
                  </ul>
                   <?php }
                    ?>  
                    
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
            <!--<section>-->
              <section class="vbox">
                <section class="scrollable padder">              
                  <section class="row m-b-md">
                    <div class="col-sm-6">
                      <h3 class="m-b-xs text-black">
                       <?php if($userLevel==2 || $userLevel == 7){
                        echo "Manager's Attendance";
                      }else if($userLevel==3){
                          echo "Cluster Lead's Attendance";
                      }else if($userLevel==4){
                          echo "Operation Manager's Attendance";
                      }else{
                          echo "Administration Attendance";
                      } ?></h3>
                      <!--<div class="well well-sm">All about your profile. You can edit all through here.</div>-->
                       <small>Welcome back, <?php echo $this->manager_model->getFullName($userid)?>, <?php if($userLevel == 2 ){ echo $this->manager_model->getClusterName($userid); } else if($userLevel == 3) { echo $this->manager_model->getClusterLeadGroup($userid);} ?><!--<i class="fa fa-map-marker fa-lg text-primary"></i>--> </small>
                      
                    </div>
                  </section>
                  
<!--                 <?php //echo form_open('manager'); ?> -->
                     <?php echo form_open(); ?> 
                  <section id='main' class="panel b-a">
                  <div class="row">
                    <div class="col-md-6">
                            <div class="panel-heading b-b">
                            <p style="text-align: center"><a id="curDateTime" href="#" class="block h4 font-bold m-b text-black">Current Date/Time:<br> ...calculating</a></p>
                           <input type="hidden" value="<?php echo $userid?>" id="valManagerID">
                           <input type="hidden" value="<?php echo $this->manager_model->getFullName($userid)?>" id="valManagerName">
                           <input type="hidden" value="<?php echo $this->manager_model->getClusterName($userid); ?>" id="valSiteName">
                           <input type="hidden" value="<?php echo $this->manager_model->getUserEmail($userid); ?>" id="valUserEmail">
                           <input type="hidden" value="<?php echo $this->manager_model->getSiteID($userid); ?>" id="valSiteID">
                           <input type="hidden" value="" id="valDateTime">
                           <input type="hidden" value="" id="valDate">
                           <input type="hidden" value="" id="valTime">
                           <input type="hidden" value="<?php if($userLevel == 3){echo $this->manager_model->getClusterLeadGroupID($userid);} else if($userLevel == 2){echo $this->manager_model->getClusterGroupID($userid);} ?>" id="valClusterID">
                           <input type="hidden" value="" id="valAccuracy">
                           <!--<input type="hidden" value=$userid id="valManagerID">-->
                           
                            </div>
                            <!--<div class="r b bg-warning-ltest wrapper m-b">
                              <p style="text-align: center"><img src="<?php echo base_url();?>images/camera-512.png" height="180" width="180"></p>
                              <p style="text-align: center"> Disabled for Attendance V0.1</p>
                          </div>-->
                            <div class="camcontent" style="display: block; position: relative; overflow: hidden; height: 350px; width: 502px; margin: auto;">
                                <img id="camImg" src="images/camera-376.png" width="100%" height="350px">
                                <span align="center" id="uploading" style="position: absolute;color: red;font-weight: bold; display:none; z-index:300000;"> Processing . . .  </span> 
                                <span align="center" id="uploaded"  style="position: absolute;color: greenyellow;font-weight: bold; display:none; z-index:300000;"> Success, your photo has been uploaded!</span> 
                                <video id="video" autoplay></video>
                                <canvas id="canvas" width="502px" height="376.5px">
                                
                            </div>
                            <div class="cambuttons">
                                <button type="button" id="snap" style="display:none;">  Capture </button> 
                                <button type="button" id="reset" style="display:none;">  Reset  </button>     
                                <button type="button" id="upload" style="display:none;"> Upload </button> 
                                <br> 
                                <!--<span id="uploading" style="display:none;"> Uploading has begun . . .  </span> 
                                <span id="uploaded"  style="display:none;"> Success, your photo has been uploaded!</span> -->
                            </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel-heading b-b">
                            <p style="text-align: center"><a name="curLatLong" id="curLatLong" href="#" class="block h4 font-bold m-b text-black">Current Location:<br> ...calculating </a></p>                          
                         <input type="hidden" value="" id="valLatLong">
                        </div>
                            <section id="map" style="min-height:350px;"></section>
                            <div id="map"></div><br>
                    </div>
                  </div>
                      <div class="clearfix panel-footer"></div>
                      <div class="row">
                          <div id="outstationTxt" class="checkbox i-checks" style="text-align: center">
                              <label>
                                  <input id="outstation" type="checkbox"><i></i><span id="outstationspan"> Add Notes</span>
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
                                            <a id="canceloutstation" href="#" class="btn" data-dismiss="modal" >Cancel</a>
                                            <a href="#" class="btn btn-primary" id="saveoutstation">Save</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          <div>
                          <!--<div  id='punch-in'>-->
                              <p style="text-align: center">
                                  <a id="punch-in" href="#" class="btn btn-primary btn-lg" style="display: 
                                      <?php if(($this->manager_model->getLastPunchStatus($userid)) == "IN"){
                                          echo "none";
                                      } else {
                                          echo "run-in";
                                      }
                                      
                                      ?>;">
                                  <i class="fa fa-plus"></i> Punch IN</a>
                                  <input type="hidden" value="" id="valActivityStatus">
                              <!--</p>
                          </div>-->
                          
                          <!--<div  id='punch-out'>
                              <p style="text-align: center">-->
                              <a id="punch-out" href="#" class="btn btn-danger btn-lg" style="display: 
                                  <?php if(($this->manager_model->getLastPunchStatus($userid)) == "OUT" || ($this->manager_model->getLastPunchStatus($userid)) == ""){
                                          echo "none";
                                      } else{
                                          echo "run-in";
                                      }
                                      
                                      ?>;">
                                  <i class="fa fa-minus"></i> Punch OUT</a>
                              </p>
                          <!--</div>-->
                          </div><div id="success" style="text-align: center; color: green; font-weight: bold"></div>
                      </div>
                  </section>
                <section id="warning" class="panel b-a">
                    <div class="panel-heading b-b">
                          <p id="loadingTitle" class="block h4 font-bold m-b text-black">Please make sure...</p> 
                    </div><br>
                    <p style="text-indent:5px"><i class="i i-checked"></i> Your camera is enabled and shared with the system upon loading.</p>
                    <p style="text-indent:5px"><i class="i i-checked"></i> Your current location is shared upon loading.</p>
                    <p style="text-indent:5px"><i class="i i-checked"></i> If you already shared your camera and location, try to refresh the browser again. Otherwise if you think this is an error please contact <a href='mailto:support@fulkrum.net'>support@fulkrum.net</a> immediately. </i></a></p>
                    
                 </section>        
                <?php echo form_close(); ?><br/>
                  <div class='row'>
                      <div class="col-md-12">
                      <section class="panel b-a">
                        <div class="panel-heading b-b">
                         
                          <a href="#" class="font-bold">Recent Activities</a>
                        </div><br>
                          <div ><!--class="table-responsive"-->
                              <table id="table" class="table table-striped m-b-none" data-ride="datatables">
                                <thead>
                                  <tr>
                                    <th width="15%">Date</th>
                                    <th width="15%">Time</th>
                                    <th width="10%">Activites</th>
                                    <th width="20%">Status</th>
                                    <th width="18%">Location (Lat, Long)</th>
                                  </tr>
                                </thead>
                                <!--<tbody>
                                </tbody>-->
                             </table>
                            </div>
                      </section>
                    </div>
                  </div>
                </section>
              </section>
            <!--</section>-->            
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
      </section>
    </section>
  </section>
