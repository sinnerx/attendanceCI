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
  $('#log_table').DataTable({ 
        
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        //"pagingType": "full_numbers",
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo base_url();?>manager/ajax_log_list",
            "type": "POST"
        },
         //Set column definition initialisation properties.
        "columnDefs": [
        { 
            
        //"targets": [ -1 ], //disable last column
        "targets": [ 0,1,2,3,4 ], //disable sorting all column
            "orderable": false, //set not orderable
        },
        ],

        //red row for late in eorly out
        "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                    if ( aData[5] == "1" )
                    {
                        $('td', nRow).css('background-color', 'rgba(255, 0, 0, 0.23)');
                    }
                    else if ( aData[6] == "1" )
                    {
                        $('td', nRow).css('background-color', 'rgba(255, 0, 0, 0.23)');
                    }
                }
        //alert($userid);
    });
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

</head>
<body class="" >
    