<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
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
        "columnDefs": [{ 
            "targets": [ 0, 1, 2, 3, 4, 5, 6, 7 ], //last column
            "orderable": false //set not orderable
        },
         {
           "targets": -2,
           "data": null,
           "defaultContent": "<a href=\"#locateMap\" class=\"btn btn-default btn-xs\" data-toggle=\"modal\"><i class=\"fa fa-map-marker\"></i> Locate!</a>"
            
        },
         {
           "targets": -1,
           "data": null,
           "defaultContent": "<a href=\"#seeImg\" class=\"btn btn-default btn-xs\" data-toggle=\"modal\"><i class=\"fa fa-user\"></i></a>"
            
        }
        ]
//        "dom": 'frtip',
//        "buttons": [
//            'copyHtml5',
//            'excelHtml5',
//            'csvHtml5',
//            'pdfHtml5'
//        ]
    });
     $('#tableClusterLead tbody').on( 'click', 'a', function () {
        var data = table.row( $(this).parents('tr') ).data();
        //alert( data[0] +"'s lat,long is: "+ data[ 6 ] );
        //$("#locateMap").modal();
        //alert(data[6]);
        toDisplayName = data[0];
        toDisplayCluster = data[1];
        toDisplayDate = data[2];
        toDisplayTime = data[3];
        toDisplayActivities = data[4];
        toDisplayStatus = data[5];
        toDisplayLatLong = data[6];
        toDisplayImgIn = data[7];
        displayMap();
        displayImg();
    } );
 });
 
 function displayMap(){
    console.log(toDisplayLatLong);
    //var  str_array = toDisplayLatLong;
    var str_array = toDisplayLatLong.split(',');
    for(var i = 0; i < str_array.length; i++) {
       // Trim the excess whitespace.
       //str_array[i] = str_array[i].replace(/^\s*/, "").replace(/\s*$/, "");/\x{00B0}/
       //Trim the excess whitespace and degree symbol for old records
       str_array[i] = str_array[i].replace(/^\s*/, "").replace(/\s*$/, "").replace(/°/,"");
       // Add additional code
      // alert(str_array[i]);
    }
    console.log(toDisplayLatLong+" | "+str_array[0]+","+str_array[1]);
    var displayLat = str_array[0];
    var displayLong = str_array[1];
    var pos = new google.maps.LatLng(displayLat, displayLong);
    var options = {
            //zoom low - furthest | high - closest
            zoom: 14,
            center: pos,
            //mapTypeId: google.maps.MapTypeId.ROADMAP
            //styler for map
            styles: [{"stylers":[{"hue":"#ff1a00"},{"invert_lightness":true},{"saturation":-100},{"lightness":33},{"gamma":0.5}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#2D333C"}]}]
    };
    var map = new google.maps.Map(document.getElementById("map"), options);
    var marker = new google.maps.Marker({
            position: pos,
            map: map,
            title: "User location"
    });
    var contentString = "<br/><b>Geolocation:</b> " + displayLat +", "+ displayLong + "<br/>";
    var infowindow = new google.maps.InfoWindow({
            content: contentString
    });
    google.maps.event.addListener(marker, 'click', function() {
            infowindow.open(map,marker);
    });
    //pass value to html/canvas
    //var latitude  = position.coords.latitude;
    //var longitude = position.coords.longitude;
            
    google.maps.event.addDomListener(window, 'load', displayMap);
    
    google.maps.event.addDomListener(window, "resize", resizingMap);

    $('#locateMap').on('show.bs.modal', function() {
       //Must wait until the render of the modal appear, thats why we use the resizeMap and NOT resizingMap!! ;-)
       resizeMap();
    });

    function resizeMap() {
       if(typeof map == "undefined") return;
       setTimeout( function(){
           resizingMap();
       } , 400);
    }

    function resizingMap() {
       if(typeof map == "undefined") return;
       var center = map.getCenter();
       google.maps.event.trigger(map, "resize");
       map.setCenter(center); 
       displayMap();
    }
 }
 
function displayImg(){
  //img exist
  
  //}
  //img dont exist
  if(toDisplayImgIn.length === 0){
      $("#imgView").attr('src', 'images/camera-376.png');
  }else{
      $("#imgView").attr('src', toDisplayImgIn);
  }
  //catch non-exist img on database
  $('#imgView').error(function() {
  //alert('Image does not exist !!');
  $("#imgView").attr('src', 'images/camera-376.png');
  });
}
    

</script>
  <section class="vbox"><?php //echo "clusterid: ".$this->clusterlead_model->getClusterLeadGroupID($userid); ?>
    <header class="bg-white header header-md navbar navbar-fixed-top-xs box-shadow">
      <div class="navbar-header aside-md dk">
        <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen" data-target="#nav">
          <i class="fa fa-bars"></i>
        </a>
        <a href="../" class="navbar-brand"><img src="<?php echo base_url();?>images/logo.png" class="m-r-sm"><?php if($userid==1){ echo "Administration Mode";}else{echo $this->clusterlead_model->getClusterLeadGroup($userid);} ?></a>
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
            <?php echo $this->clusterlead_model->getFullName($userid); ?><b class="caret"></b>
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
                <strong class="font-bold text-lt"><?php echo $this->clusterlead_model->getFullName($userid)?></strong> 
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
                       echo $this->clusterlead_model->getClusterName($userid);
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
                          <li>
                          <a href="<?php echo base_url(); ?>manager" class="auto">                                                        
                            <i class="i i-dot"></i>
                            <span>Punch IN/OUT</span>
                          </a>
                        </li>
                        <li class= 'active'>
                          <a href="<?php echo base_url(); ?>clusterlead" class="auto">                                                        
                            <i class="i i-dot"></i>
                            <span>View Log</span>
                          </a>
                        </li>
                        <li class=''>
                          <a href="<?php echo base_url(); ?>reporting" class="auto">                                                        
                            <i class="i i-dot"></i>
                            <span>View Report</span>
                          </a>
                        </li>
                        <li class=''>
                          <a href="<?php echo base_url(); ?>clusterlead/viewAbsent" class="auto">                                                        
                            <i class="i i-dot"></i>
                            <span>View Manager Absent</span>
                          </a>
                        </li>                                             
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
                      <h3 class="m-b-xs text-black"><?php echo $this->clusterlead_model->getClusterLeadGroup($userid); ?> Attendance List</h3>
                      <!--<div class="well well-sm">All about your profile. You can edit all through here.</div>-->
                       <small>Welcome back, <?php echo $this->clusterlead_model->getFullName($userid)?>, <?php echo $this->clusterlead_model->getClusterLeadGroup($userid); ?><!--<i class="fa fa-map-marker fa-lg text-primary"></i>--> </small>
                    </div>
                  </section>
                  

                      
                  <div class='row'>
                      <div class="col-md-12">
                      <section class="panel b-a">
                        <div class="panel-heading b-b">
                          <a href="#" class="font-bold">Activities</a>
                        </div><br>
                          <div class="table-responsive">
                              <table id="tableClusterLead" class="table table-striped m-b-none">
                              <!--<table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">-->
                                <thead>
                                  <tr>
                                    <th>Name</th>
                                    <th>Site</th>
                                    <th width="12%">Date</th>
                                    <th>Time</th>
                                    <th>Activites</th>
                                    <th>Status</th>
                                    <!--<th>Location (Lat, Long)</th>-->
                                    <th width="8%">Location</th>
                                    <th width="3%">Image</th>
                                  </tr>
                                </thead>
                                <tbody>
                                </tbody>
                              </table>
                            </div>
                        <!-- map modal -->
                        
                        <div id="locateMap" class="modal fade" tabindex="-1" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="checkbox" class="close" data-dismiss="modal" id="canceloutstation_X">×</button>
                                            <h4 style="text-align: center">Geolocation (Latitute, Longitute)</h4>
                                        </div>
                                        
                                        <div class="modal-body">
                                            <div id="map" class="" style="width:560px; height:350px;"></div>
                                            
                                        </div>
                                        <div class="modal-footer">
                                            <a href="#" class="btn btn-primary" data-dismiss="modal" >Close</a>
                                            
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <!-- end map modal-->
                        <!-- img modal -->
                        <div id="seeImg" class="modal fade" tabindex="-1" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="checkbox" class="close" data-dismiss="modal" id="canceloutstation_X">×</button>
                                            <h4 style="text-align: center">Punch Image</h4>
                                        </div>
                                        
                                        <div class="modal-body">
                                            <div class="" style="width:560px; height:376px; display: block; margin: 0 auto;">
                                                <img id="imgView" src="images/camera-376.png">
                                            </div>
                                            
                                        </div>
                                        <div class="modal-footer">
                                            <a href="#" class="btn btn-primary" data-dismiss="modal" >Close</a>
                                            
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <!-- end img modal-->
                       <!--<div class="clearfix panel-footer">-->
                        </div>
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
