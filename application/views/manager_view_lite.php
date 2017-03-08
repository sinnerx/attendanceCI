<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
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
  // $('#log_table').DataTable( {
  //       "ajax": '<?php echo base_url();?>manager/ajax_list',
  //       "order": [[ 0, "desc" ]]
  //   } );
    loadCamera();
       //punch-in   
       latestActivity("<?php echo $userid;?>");
      $( "#punch-in" ).click(function(event) {
          $( "#snap" ).click();
//          $( "#punch-in" ).hide();
//          $( "#punch-out" ).show();
//          $( "#punch-out" ).addClass('disabled');
            $(this).button('loading');
            event.preventDefault();
            var  activityStatus = punchStatus = 'IN';
            var  outstationStatus = $("#outstationStatusTxt").val();
            var  latLongIn = $("#valLatLong").val();
            var  accuracy = $("#valAccuracy").val();
            //var  imgIn = 'images/attendance/noimage.jpg';
            jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>manager/saveAttendance",
            //dataType: "JSON",
            data: {latLongIn: latLongIn, accuracy: accuracy, activityStatus: activityStatus, outstationStatus: outstationStatus},
            success: function (data) {
                    //table.ajax.reload(null,false);
                    console.log(data);
                    //reload_table();
                    notify();
                    $("#upload").click();
                    latestActivity(data);
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
//        $( "#punch-out" ).hide();
//        $( "#punch-in" ).show();
//        $( "#punch-in" ).addClass('disabled');
        $(this).button('loading');
        event.preventDefault();
        var  activityStatus = punchStatus = 'OUT';
        var  outstationStatus = $("#outstationStatusTxt").val();
        var  latLongIn = $("#valLatLong").val();
        var  accuracy = $("#valAccuracy").val();
        //var  imgIn = 'images/attendance/noimage.jpg';

        jQuery.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>manager/saveAttendance",
        //dataType: "JSON",
        data: {latLongIn: latLongIn, accuracy: accuracy, activityStatus: activityStatus, outstationStatus: outstationStatus},
        success: function (data) {
                //table.ajax.reload(null,false);
                console.log(data);
                //reload_table();
                notify();
                $("#upload").click();
                latestActivity(data);

        },
        error: function (jqXHR, textStatus, errorThrown)
            {
                alert("Error: jqXHR: "+jqXHR+" | textStatus: "+textStatus+" | errorThrown: "+errorThrown);
                //reload_table();
            }
     });
    //reload_table();
    });

function latestActivity(data){
    $.ajax({                    
            type: "GET",
            url: "<?php echo base_url(); ?>manager/ajax_list",
            data: data,
            beforeSend: function(){
                $("#statusTxt").remove();  
                $("#statusHead").append("<p id=\"statusTxt\" class=\"block h4 font-bold m-b text-black\">My Last Activities</p>");
                $("#latestActivity").html('<i class=\'fa fa-cog fa-spin\'></i> Loading last activity\'s...');
            },
            success: function(data){
                 var data_json = JSON.parse(data).data[0];
                console.log('JSON: '+JSON.parse(data).data[0]);
                $("#latestActivity").html(
                        '<b>Punch:</b> '+data_json[0]+'<br>'+
                        '<b>Date:</b> '+data_json[1]+'<br>'+
                        '<b>Time:</b> '+data_json[2]+'<br>'+
                        '<b>GPS:</b> '+data_json[3]+'<br>'+
                        '<b>Notes:</b> '+data_json[4]+'<br>'
                        );
                if(data_json[5]){
                    
                    for(var i=0; i <5; i++){
                        $("#label"+i).removeClass('label bg-warning').addClass('label bg-light');
                    }
                    $("#label"+parseInt(data_json[5]+1)).removeClass('label bg-light').addClass('label bg-warning');
                }else{
                    $("#label1").removeClass('label bg-light').addClass('label bg-warning');
                }
                if(data_json[5] == 4){
                    console.log('4th times!');
                     $("#punch-in").removeClass('btn btn-primary btn-lg');
                     $("#punch-in").addClass('btn btn-primary btn-lg disabled');
                     //console.log($("#punch-in").addClass('btn btn-primary btn-lg '));
                }
                
                $("#statusTxt").remove();  
                $("#statusHead").append("<p id=\"statusTxt\" class=\"block h4 font-bold m-b text-black\">My Last Activities<span class=\"label label-lg bg-success\">Success!</span></p>");  
            
            }, 
            error: function ()
            {
              $("#statusTxt").remove(); 
              $("#statusHead").append("<p id=\"statusTxt\" class=\"block h4 font-bold m-b text-black\">My Last Activities<span class=\"label label-lg bg-danger\">Error!</span></p>");
            },
            complete:function(){
              }
         });
}
    
    $('input,textarea').focus(function () {
        $(this).data('placeholder', $(this).attr('placeholder'))
               .attr('placeholder', '');
    }).blur(function () {
        $(this).attr('placeholder', $(this).data('placeholder'));
    });
    
    function loadCamera() {
            console.log('load camera');
            // Grab elements, create settings, etc.
            canvas = document.getElementById("canvas"),
                context = canvas.getContext("2d"),
                
                video = document.getElementById("video"),
                videoObj = { "video": true },
                image_format= "jpeg",
                jpeg_quality= 85,
                errBack = function(error) {
                    console.log("Video capture error: ", error.code); 
                };
                //ratio 4:3
                canvas.width = 502;
                canvas.height = 376.5;

            // Put video listeners into place
            if(navigator.getUserMedia) { // Standard
                navigator.getUserMedia(videoObj, function(stream) {
                    video.src = window.URL.createObjectURL(stream);
                    //video.src = stream;
                    //ratio 4:3
                    video.width = 502;
                    video.height = 376.5;
                    video.play();
                    checkVideoID(true);
                    //$("#snap").show();
                }, errBack);
                console.log('errBack1: '+errBack);
            } else if(navigator.webkitGetUserMedia) { // WebKit-prefixed
                navigator.webkitGetUserMedia(videoObj, function(stream){
                    //video.src = window.webkitURL.createObjectURL(stream);
                    video.src = window.URL.createObjectURL(stream);
                    //ratio 4:3
                    video.width = 502;
                    video.height = 376.5;
                    video.play();
                    checkVideoID(true);
                    //$("#snap").show();
                }, errBack);
                console.log('errBack2: '+errBack);
            } else if(navigator.mozGetUserMedia) { // moz-prefixed
                console.log('Mozilla');
//                navigator.mozGetUserMedia(videoObj, function(stream){
//                    video.src = window.URL.createObjectURL(stream);
//\                    video.width = 502;
//                    video.height = 376.5;
//                    video.play();
//                }, errBack);
//                console.log('errBack3: '+errBack);
            var constraints = { audio: false, video: { width: 502, height: 376.5 } };
            navigator.mediaDevices.getUserMedia(constraints)
            .then(function(stream) {
              var video = document.querySelector('video');
              video.src = window.URL.createObjectURL(stream);
              video.onloadedmetadata = function(e) {
                video.play();
                checkVideoID(true);
              };
            })
            .catch(function(err) {
              console.log(err.name + ": " + err.message);
              checkVideoID(false);
            });
                vidSrc = video.src;
                console.log('vidSrc:'+vidSrc);
            }
            
            
                  // video.play();       these 2 lines must be repeated above 3 times
                  // $("#snap").show();  rather than here once, to keep "capture" hidden
                  //                     until after the webcam has been activated.  
                   //console.log('canvas:'+canvas);
                   //console.log('video.src:'+video.src);
                   //vidSrc = video.src;
                   //console.log('vidSrc:'+vidSrc);
                //checkVideoID();   
            // Get-Save Snapshot - image 
              $( "#snap" ).click(function(event) {
                context.drawImage(video, 0, 0, 502, 376.5);
                 $("#video").hide();
                $("#canvas").show();
            });
            // reset - clear - to Capture New Photo
            //document.getElementById("reset").addEventListener("click", function() {
             $( "#reset" ).click(function(event) {
                //$("#video").fadeIn("slow");
                //$("#canvas").fadeOut("slow");
                $("#video").show();
                $("#canvas").hide();
                //$("#snap").show();
                //$("#reset").hide();
                //$("#upload").hide();
            });
            // Upload image to sever 
            //document.getElementById("upload").addEventListener("click", function(){
             $( "#upload" ).click(function(event) {
                var dataUrl = canvas.toDataURL("image/jpeg", 0.85);
                $("#uploading").show();
                $.ajax({
                  type: "POST",
                  url: "manager/saveface",
                  data: { 
                     imgBase64: dataUrl,
                     //user: "Joe",       
                     //userid: 25   
                     //userid: $("#valManagerID").val(),
                     //punchStatus: punchStatus,
                     //activityDateData: activityDateData,
                     //activityTimeData: activityTimeData
                     
                  }
                }).done(function(msg) {
                  console.log(activityDateData+" | "+activityTimeData+" | "+punchStatus);
                  console.log("saved");
                  $("#uploading").hide();
                  $("#uploaded").show();
                  //checkVideoID();
                });
            });
        }
 });

function notify(){
    //alert("datetime: "activityDate + activityTime);
           var div = document.getElementById('success');
            div.innerHTML += 'Data successfully submitted!';
            console.log('success!!!');
            function f() { 
                $("#success").fadeOut('slow');   
                $( "#punch-in" ).removeClass('disabled');
                $( "#punch-out" ).removeClass('disabled');
                $( "#punch-in" ).button('reset');
                $( "#punch-out" ).button('reset');
                if($('#punch-in').is(':visible')) {
                    $('#punch-in').hide();
                    $('#punch-out').show();
                } else if($('#punch-out').is(':visible')){
                    $('#punch-in').show();
                    $('#punch-out').hide();
                }
                //reset check box
                $('#outstationStatusTxt').val("");
                $('#outstationspan').text(" Add Notes");
                $('#outstation').prop('checked', false);
                $("#reset").click();
                $("#uploading").hide();
                $("#uploaded").hide();
    }
    setTimeout(f, 1500);        
}


 function checkVideoID (vid_src){
        //video_src = document.getElementById("video").src;
        console.log('video_src: '+vid_src);
      if(vid_src === true){
          document.getElementById("main").style.display = "";
          document.getElementById("camImg").style.display = "none";
          document.getElementById("loadingTitle").innerHTML = "Please make sure...";
      } else {
          //console.log("loadingTitle: "+document.getElementById("loadingTitle").innerHTML);
          document.getElementById("loadingTitle").innerHTML = "Camera Module Temporary Disabled...please make sure:";
         // loadCamera();
      }
 }

</script>

  <section class="vbox">
    <header class="bg-white header header-md navbar navbar-fixed-top-xs box-shadow">
      <div class="navbar-header aside-md dk">
        <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen" data-target="#nav">
          <i class="fa fa-bars"></i>
        </a>
        <a href="../" class="navbar-brand"><img src="<?php echo base_url();?>images/logo.png" class="m-r-sm">
            
            <?php if($userLevel==99){ 
                echo "Administration Mode";
            }else if($userLevel == 3 ){ 
                echo $getClusterLeadGroup; 
            }else if($userLevel == 4 ){ 
                echo "Operation Manager"; 
            }else{
                 echo $getSiteName;
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
          <?php if ($userLevel != 7) { ?>
          <a onclick="return true;" href="../dashboard" target="_self" style="border-left:1px dashed #CECECE;color: #8B8B8B;letter-spacing: 1px"><span class="btn btn-success">Go to Pi1M <span class="not-connected-text"></span></span></a>
          <?php } ?>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right m-n hidden-xs nav-user user">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <span class="thumb-sm avatar pull-left">
              <img src="<?php echo base_url();?>images/a0.png">
            </span>
            <?php echo $getFullName; ?><b class="caret"></b>
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
                <strong class="font-bold text-lt"><?php echo $getFullName; ?></strong> 
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
                  <?php if($userLevel == 2 || $userLevel == 7 ){ ?>
                  <ul class="nav nav-main" data-ride="collapse">
                      <li class="active">
                      <a href="#" class="auto">
                        <i class="i i-statistics icon">
                        </i>
                        <span class="font-bold">Attendance</span>
                      </a>
                      <ul class='nav dk'>
                          <li class='active'>
                          <a href="./" class="auto">                                                        
                            <i class="i i-dot"></i>
                            <span>Punch IN/OUT</span>
                          </a>
                        </li>
                        <li >
                          <a href="./manager/viewLog" class="auto">                                                        
                            <i class="i i-dot"></i>
                            <span>View Log</span>
                          </a>
                        </li>
                        <li >
                          <a href="./manager/viewAbsent" class="auto">                                                        
                            <i class="i i-dot"></i>
                            <span>View Absence</span>
                          </a>
                        </li>                          
                      </ul>
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
                        <li>
                          <a href="./clusterlead/viewAbsent/" class="auto">                                                        
                            <i class="i i-dot"></i>
                            <span>View Manager Absent</span>
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
                       <?php if($userLevel==2){
                        echo "Manager's Attendance";
                      }else if($userLevel==3){
                          echo "Cluster Lead's Attendance";
                      }else if($userLevel==4){
                          echo "Operation Manager's Attendance";
                      }else{
                          echo "Administration Attendance";
                      } ?></h3>
                      <!--<div class="well well-sm">All about your profile. You can edit all through here.</div>-->
                       <small>Welcome back, <?php echo $getFullName?>, <?php if($userLevel == 2 ){ echo $getSiteName; } else if($userLevel == 3) { echo $getClusterLeadGroup;} ?></small>
                      
                    </div>
                  </section>
<!--                  <div id="cover">LOADING</div>-->
<!--                 <?php //echo form_open('manager'); ?> -->
                     <?php echo form_open(); ?> 
                  <section id='main' class="panel b-a">
                  <div class="row">
                    <div class="col-md-6">
                            <div class="panel-heading b-b">
                                <p style="text-align: center" class="block h4 font-bold m-b text-black">Server Date/Time: <?php echo date("d-m-Y G:i");?></p>
                                <p style="text-align: center" class="block h4 font-bold m-b text-black" id="curDateTime">Local Date/Time: ...calculating</p>

                           <input type="hidden" value="<?php if($userLevel == 3){echo $getClusterLeadGroupID;} else if($userLevel == 2){echo $getClusterGroupID;} ?>" id="valClusterID">
                           <input type="hidden" value="" id="valAccuracy">
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
                            <p style="text-align: center" name="curLatLong" id="curLatLong" href="#" class="block h4 font-bold m-b text-black">Current Location:<br><br> ...calculating</p>                          
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
                                        <div class="modal-body"><h3 style="text-align: center">Attendance Note</h3>
                                            <p>
                                                <textarea style="width:100%" name="outstationStatusTxt" id="outstationStatusTxt" rows="6" placeholder=" Please state your reason..."></textarea>
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
                              <p style="text-align: center">
                                  <a id="punch-in" href="#" class="btn btn-primary btn-lg <?php echo $isFourthPunched;?>" data-loading-text="Updating, please wait... <i class='fa fa-cog fa-spin'></i>" style="display: 
                                      <?php if($getLastPunchStatus == "IN"){
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
                          
                                <a id="punch-out" href="#" class="btn btn-danger btn-lg <?php echo $isFourthPunched;?>" data-loading-text="Updating, please wait... <i class='fa fa-cog fa-spin'></i>" style="display: 
                                  <?php if($getLastPunchStatus == "OUT" || $getLastPunchStatus == ""){
                                          echo "none";
                                      } else{
                                          echo "run-in";
                                      }
                                      
                                      ?>;">
                                  <i class="fa fa-minus"></i> Punch OUT</a>
                              </p>
                          <!--</div>-->
                          </div>
                          <div class="m-b-lg text-center">
                            <span id="label1" class="label bg-light" data-toggle="tooltip" data-original-title="1st punch">Day IN</span>
                            <span id="label2" class="label bg-light" data-toggle="tooltip" data-original-title="2nd punch">Lunch OUT</span>
                            <span id="label3" class="label bg-light" data-toggle="tooltip" data-original-title="3rd punch">Lunch IN</span>
                            <span id="label4" class="label bg-light" data-toggle="tooltip" data-original-title="4th punch">Day OUT</span>
                          </div>
                          <div id="success" style="text-align: center; color: green; font-weight: bold"></div>
                      </div>
                  </section>
                <div class="col-md-8"><section id="warning" class="panel b-a">
                    
                    <div class="panel-heading b-b">
                          <p id="loadingTitle" class="block h4 font-bold m-b text-black">Please make sure...</p> 
                    </div><br>
                    <p style="text-indent:5px"><i class="i i-checked"></i> Your camera is enabled and shared with the system upon loading.</p>
                    <p style="text-indent:5px"><i class="i i-checked"></i> Your current location is shared upon loading.</p>
                    <p style="text-indent:5px"><i class="i i-checked"></i> If you already shared your camera and location, try to refresh the browser again. Otherwise if you think this is an error please contact <a href='mailto:support@fulkrum.net'>support@fulkrum.net</a> immediately. </i></a></p>
                    
                 </section></div>
                <div class="col-md-4"><section id="warning" class="panel b-a">
                    
                    <div  id="statusHead" class="panel-heading b-b">
                        <p id="statusTxt" class="block h4 font-bold m-b text-black">My Last Activities</p> 
                    </div><br>
<!--                    <p style="text-indent:5px"><i class="i i-checked"></i><strike> Your camera is enabled and shared with the system upon loading.</strike></p>
                    <p style="text-indent:5px"><i class="i i-checked"></i> Your current location is shared upon loading.</p>
                    <p style="text-indent:5px"><i class="i i-checked"></i> If you already shared your <strike>camera and</strike> location, try to refresh the browser again. Otherwise if you think this is an error please contact <a href='mailto:support@fulkrum.net'>support@fulkrum.net</a> immediately. </i></a></p>
                    -->
                    <div id="latestActivity"><i class='fa fa-cog fa-spin'></i> Loading last activity's...</div>
                 </section></div>
                <?php echo form_close(); ?><br/></p>
                </section>
              </section>
            <!--</section>-->            
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
      </section>
    </section>
  </section>

