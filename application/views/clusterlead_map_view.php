<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<script type="text/javascript">

//alert(get_post['cluster']+ 'aaaaaa');
$(document).ready(function() {
<?php $query = http_build_query($_POST); ?>

$('#dateFrom').datepicker({ dateFormat: 'dd-mm-yy' });
    $('#dateTo').datepicker({ dateFormat: 'dd-mm-yy' });      

      $("#sitename").autocomplete({
        source: "map/get_site", // path to the get_birds method
        select: function (event, ui){
          event.preventDefault();
          $("#sitename").val(ui.item.label);
          //PK.render(ui.item.value);
          //console.log(ui.item.value);
          $("#siteid").val(ui.item.value);
          //alert($("#siteid").val());
          //$("#siteid").val();
        }
      });

      $("#username").autocomplete({
        source: "map/get_user", // path to the get_birds method
        select: function (event, ui){
          event.preventDefault();
          $("#username").val(ui.item.label);
          //PK.render(ui.item.value);
          //console.log(ui.item.value);
          $("#userid").val(ui.item.value);
          //alert($("#siteid").val());
          //$("#siteid").val();
        }
      });

      $("#regionTESTTTTT").change(function(){
      //$("#region").change(function(){
        //console.log('region clicked');
          var id = $(this).val();
          //console.log(id);
          $.ajax({
            url : "map/get_cluster",
            data : "region_selected=" + $(this).val(),
            dataType : 'json',
            //async : false,
            success : function(response){
                data = response;
                //var obj = jQuery.parseJSON(data);
                //console.log(data);
                var select = $('#cluster');
                select.empty();
                $.each(data, function(index, value) { 
                  console.log(index);         
                    select.append(
                            $('<option></option>').val(index).html(value)
                        );
                });
                //return data;
            },
            error: function() {
              alert('Error occured');
            }
          });
      });

      $("#forpi1m").change(function(){
        // '1'  => 'All Pi1M Managers',
        // '2'  => 'All Nusuara Staff',
        // '3'  => 'Region',
        // '4' => 'Cluster',
        // '5' => 'Pi1M Site',
        // '6' => 'Manager',
        // '7' => 'Staff',   
          if($("#forpi1m").val() == '1'){
            hide_all();
            //$("#region_div").show();
          }        
          else if($("#forpi1m").val() == '2'){
            hide_all();
            //$("#region_div").show();
          }             
          else if($("#forpi1m").val() == '3'){
            hide_all();
            $("#region_div").show();
          }
          else if ($("#forpi1m").val() == '4'){
            hide_all();
            $.ajax({
                type: 'GET',
                dataType: "json",
                url: 'map/get_clusterbyuser?'+ 'userid=' + '<?php echo $userid; ?>' + '&userlevel=' + '<?php echo $userLevel; ?>',
                
                success: function (data){
                    console.log(data);
                    $el = $("#cluster");
                    $el.empty();
                    //$el.append($("<option></option>")
                    //        .attr("value", '').text('Please Select'));
                    $.each(data, function(value, key) {
                        $el.append($("<option></option>")
                                .attr("value", value).text(key));
                      });
                }
            });
            $("#cluster_div").show();
          }
          else if ($("#forpi1m").val() == '5'){
            hide_all();
            $("#site_div").show();
          }
          else if ($("#forpi1m").val() == '6'){
            hide_all();
            $("#manager_div").show();
          }                          
      });
  
      function hide_all(){
          $("#region_div").hide();
          $("#region").val('1');

          $("#cluster_div").hide();
          $("#cluster").val('');

          $("#site_div").hide(); 
           $("#sitename").val('');
           $("#siteid").val('');

          $("#manager_div").hide(); 
          $("#username").val('');
          $("#userid").val('');
      }

      $("#submitbtn").click(function(){
         // displayClusterMap();
         //initClick();
            console.log($("form").serialize());
            console.log("<?php echo base_url() . 'map/attendance_list/?';?>" + $("form").serialize());
            $.ajax({
                type: 'GET',
                dataType: "json",
                url: 'map/attendance_list',
                data: $("form").serialize(),
                success: function(data) {
                    //alert(data);
                    var tableData = data;
                    //console.log("tableData: "+tableData);
                    //$("#testdiv").text(tableData);
                    oTable = $('#tableClusterLeadMap').DataTable({ 
                        "data": tableData,
                        "bDestroy":true,
                        //"ajax": "reporting/attendance_list",
                        //"processing": true, //Feature control the processing indicator.
                        //"serverSide": true, //Feature control DataTables' server-side processing mode.
                        "order": [], //Initial no order.
//                        dom: 'Bfrtip',
//                        buttons: [
//                            'copy', 'csv', 'excel', 'pdf', 'print'
//                        ],
                        // Load data for the table's content from an Ajax source
                        // "ajax": {
                        //     "url": "<?php echo base_url() . 'map/attendance_list/?' . $query;?>",
                        //     "type": "POST"
                        // },

                        //Set column definition initialisation properties.
                        "columns": [
                          {title : "Date", width: "20%" },              //0
                          {title : "Name" },              //1
                          {title : "Map", width: "10%" },
                          {title : "Latlong1" },                //2
                          {title : "Latlong2" },         //3
                          {title : "Latlong3" },          //4
                          {title : "Latlong4" },               //5               
//                          {title : "Late In" },           //6
//                          {title : "Break Early Out" },   //7
//                          {title : "Break Late In" },     //8
//                          {title : "Early Out" },         //9
//                          
//                          {title : "Anomaly" },           //10
//                           {title : "Note" },
                            
                        ],

//                        "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
//                            if ( aData[10] == "x" )
//                            {
//                                $('td', nRow).css('background-color', 'rgba(255, 0, 0, 0.23)');
//                            }
//                            else if ( aData[10] == "" )
//                            {
//                                //$('td', nRow).css('background-color', 'Orange');
//                            }
//                            if ( aData[6] == "x")
//                            {
//
//                                //jQuery('td:eq(2)', nRow).addClass('redText');
//                                jQuery('td:eq(2)', nRow).css('color', 'rgba(255, 0, 0, 100)');
//                                if (aData[11] != ""){
//                                    //jQuery('td:eq(2)', nRow).prop('title', aData[11]);
//                                    //jQuery('td:eq(2)', nRow).append('<div class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="'+ aData[11] +'"></div>');
//                                    jQuery('td:eq(2)', nRow).attr('class', "fa fa-info-circle");
//                                    jQuery('td:eq(2)', nRow).attr('data-toggle', "tooltip");
//                                    jQuery('td:eq(2)', nRow).attr('data-placement', "top");
//                                    jQuery('td:eq(2)', nRow).attr('title', aData[11] );
//                                    
//                                }
//                                  
//                            }
//                            if (aData[7] == "x")
//                            {
//                                jQuery('td:eq(3)', nRow).css('color', 'rgba(255, 0, 0, 100)');
//                                if (aData[11] != ""){
//                                    //jQuery('td:eq(2)', nRow).prop('title', aData[11]);
//                                    //jQuery('td:eq(2)', nRow).append('<div class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="'+ aData[11] +'"></div>');
//                                    jQuery('td:eq(3)', nRow).attr('class', "fa fa-info-circle");
//                                    jQuery('td:eq(3)', nRow).attr('data-toggle', "tooltip");
//                                    jQuery('td:eq(3)', nRow).attr('data-placement', "top");
//                                    jQuery('td:eq(3)', nRow).attr('title', aData[11] );
//                                    
//                                }                                
//                            }                            
//                            if (aData[8] == "x")
//                            {
//                                jQuery('td:eq(4)', nRow).css('color', 'rgba(255, 0, 0, 100)');
//                                if (aData[11] != ""){
//                                    //jQuery('td:eq(2)', nRow).prop('title', aData[11]);
//                                    //jQuery('td:eq(2)', nRow).append('<div class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="'+ aData[11] +'"></div>');
//                                    jQuery('td:eq(4)', nRow).attr('class', "fa fa-info-circle");
//                                    jQuery('td:eq(4)', nRow).attr('data-toggle', "tooltip");
//                                    jQuery('td:eq(4)', nRow).attr('data-placement', "top");
//                                    jQuery('td:eq(4)', nRow).attr('title', aData[11] );
//                                    
//                                }                                
//                            }
//                            if (aData[9] == "x")
//                            {
//                                jQuery('td:eq(5)', nRow).css('color', 'rgba(255, 0, 0, 100)');
//                                if (aData[11] != ""){
//                                    //jQuery('td:eq(2)', nRow).prop('title', aData[11]);
//                                    //jQuery('td:eq(2)', nRow).append('<div class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="'+ aData[11] +'"></div>');
//                                    jQuery('td:eq(5)', nRow).attr('class', "fa fa-info-circle");
//                                    jQuery('td:eq(5)', nRow).attr('data-toggle', "tooltip");
//                                    jQuery('td:eq(5)', nRow).attr('data-placement', "top");
//                                    jQuery('td:eq(5)', nRow).attr('title', aData[11] );
//                                    
//                                }                                
//                            }                            
//
//                        },
                        "columnDefs": [{ 
                                    "targets": [ 2 ], //last column
                                    "orderable": false //set not orderable
                                },
                                 {
                                   "targets": 2,
                                   "data": null,
                                   "defaultContent": "<a href=\"#locateClusterMap\" class=\"btn btn-default btn-xs\" data-toggle=\"modal\"><i class=\"fa fa-map-marker\"></i> All Locations!</a>"

                                },
//                        "columnDefs": [
//                              {
//                                  //"targets": [ 2 ],
//                                  //"visible": false,
//                                  //"searchable": false
//                              },
//                              {
////                                  "targets": [ 6 ],
////                                  "visible": false,
////                                  "searchable": false
//                              },
//                              {
//                                  "targets": [ 7 ],
//                                  "visible": false,
//                                  "searchable": false
//                              },
                              {
                                  "targets": [ -1,-2,-3,-4 ],
                                  "visible": false,
                                  "searchable": false
                              },
//                              {
//                                  "targets": [ 9 ],
//                                  "visible": false,
//                                  "searchable": false
//                              },
//                              {
//                                  "targets": [ 10 ],
//                                  "visible": false,
//                                  "searchable": false
//                              },                               
//                              {
//                                  "targets": [ 11 ],
//                                  "visible": false,
//                                  "searchable": false
//                              },                                                                                                                                                      
                             ]


                    });//end datatable

          //console.log('oTable: '+oTable.row());
          //console.log("tbody id: "+$('#tableClusterLeadMap tbody'));
          $('#tableClusterLeadMap tbody').on( 'click', 'a', function () {
                //console.log("cli");
                var datamap = [];
                data = oTable.row( $(this).parents('tr') ).data();
                //alert( data[0] +"'s lat,long is: "+ data[ 6 ] );
                //$("#locateMap").modal();
                //console.log("data: "+data[2]);
                //datamap = data[2];
                console.log("datamap :"+data[2]);
    //            toDisplayName = data[0];
    //            toDisplayCluster = data[1];
    //            toDisplayDate = data[2];
    //            toDisplayTime = data[3];
    //            toDisplayActivities = data[4];
    //            toDisplayStatus = data[5];
    //            toDisplayLatLong = data[6];
    //            toDisplayImgIn = data[7];
                datamap1 = data[3];
                datamap2 = data[4];
                datamap3 = data[5];
                datamap4 = data[6];
                displayClusterMap(datamap1, datamap2,datamap3,datamap4);
//                google.maps.event.addDomListener(window, 'load', displayClusterMap);
//                google.maps.event.addDomListener(window, "resize", resizingClusterMap);

            } );


                }
            });

            
        
        
      });
      
      
          
        
}); 
//displayClusterMap();
function displayClusterMap(datamap1,datamap2,datamap3,datamap4){
    console.log('data in cluster: '+datamap1+"|"+datamap2+"|"+datamap3+"|"+datamap4);
    // Creating an object literal containing the properties we want to pass to the map 
    var options = { 
        zoom: 3, 
        //malaysia 
        center: new google.maps.LatLng(3.1333, 101.7000), 
        //mapTypeId: google.maps.MapTypeId.ROADMAP 
        styles: [{"stylers":[{"hue":"#ff1a00"},{"invert_lightness":true},{"saturation":-100},{"lightness":33},{"gamma":0.5}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#2D333C"}]}]

    }; 

    // Creating the map 
    var map = new google.maps.Map(document.getElementById('map_canvas'), options); 

    // Creating a LatLngBounds object 
    var bounds = new google.maps.LatLngBounds(); 

    // Creating an array that will contain the addresses 
    var places = []; 

    // Creating a variable that will hold the InfoWindow object 
    var infowindow; 

    var popup_content = ["<p>DTR Medical<\/p><img src=\"http:\/\/www.mediwales.com\/mapping\/wp-content\/uploads\/2011\/09\/dtr-logo.png\" \/><br \/><br \/><a href=\"http:\/\/www.mediwales.com\/mapping\/home\/dtr-medical\/\">View profile 1<\/a>","<p>MediWales<\/p><img src=\"http:\/\/www.mediwales.com\/mapping\/wp-content\/uploads\/2011\/09\/index.png\" \/><br \/><br \/><a href=\"http:\/\/www.mediwales.com\/mapping\/home\/mediwales\/\">View profile 2<\/a>","<p>Teamworks Design & Marketing<\/p><img src=\"http:\/\/www.mediwales.com\/mapping\/wp-content\/uploads\/2011\/09\/Teamworks-Design-Logo.png\" \/><br \/><br \/><a href=\"http:\/\/www.mediwales.com\/mapping\/home\/teamworks-design-and-marketing\/\">View profile 3<\/a>","<p>Acuitas Medical<\/p><img src=\"http:\/\/www.mediwales.com\/mapping\/wp-content\/uploads\/2011\/09\/acuitas-medical-logo.gif\" \/><br \/><br \/><a href=\"http:\/\/www.mediwales.com\/mapping\/home\/acuitas-medical\/\">View profile 4<\/a>"];
    var address = ["17 Clarion Court, Llansamlet, Swansea, SA6 8RF","7 Schooner Way, , Cardiff, CF10 4DZ","65 St Brides Rd, Aberkenfig, Bridgend, CF32 9RA","Kings Road, , Swansea, SA1 8PH","Unit 20 Abenbury Way, Wrexham Industrial Estate, Wrexham, LL13 9UG"];
    var geocoder = new google.maps.Geocoder(); 

    var markers = [];
    var places = [
        new google.maps.LatLng(5.077528,100.978211),
        new google.maps.LatLng(5.83264,100.906555),
        new google.maps.LatLng(5.508742,100.259048),
        new google.maps.LatLng(5.467697,100.208923),
//        new google.maps.LatLng(datamap1),
//        new google.maps.LatLng(datamap2),
//        new google.maps.LatLng(datamap3),
//        new google.maps.LatLng(datamap4),
        //new google.maps.LatLng(5.628248,100.923035)
    ];
     
     
    // Adding a LatLng object for each city  
    for (var i = 0; i < places.length; i++) { 
        //places[i] = results[0].geometry.location;
        
        // Adding the markers 
        var marker = new google.maps.Marker({position: places[i], map: map, draggable:true});
        
        markers.push(marker);

        // Creating the event listener. It now has access to the values of i and marker as they were during its creation
        google.maps.event.addListener(marker, 'click', function() {
            console.log("i b4: "+i);
            // Check to see if we already have an InfoWindow
            if (!infowindow) {
                infowindow = new google.maps.InfoWindow();
            }

            // Setting the content of the InfoWindow
           console.log("i: "+i);
           infowindow.setContent(popup_content[i]);
            //alert(infowindow.setContent(popup_content[0]));
            // Tying the InfoWindow to the marker 
            infowindow.open(map, marker);
        });

        // Extending the bounds object with each LatLng 
        bounds.extend(places[i]); 

        // Adjusting the map to new bounding box 
        map.fitBounds(bounds) ;
    } 

    var markerCluster = new MarkerClusterer(map, markers, {
            zoomOnClick: true,
            averageCenter: true
        });


//    google.maps.event.addDomListener(window, 'load', displayClusterMap);
//    
//    google.maps.event.addDomListener(window, "resize", resizingClusterMap);

    $('#locateClusterMap').on('show.bs.modal', function() {
       //Must wait until the render of the modal appear, thats why we use the resizeMap and NOT resizingMap!! ;-)
       resizeClusterMap(datamap);
    });

    function resizeClusterMap(datamap) {
       if(typeof map == "undefined") return;
       setTimeout( function(){
           resizingClusterMap();
       } , 400);
    }

    function resizingClusterMap() {
       if(typeof map == "undefined") return;
       var center = map.getCenter();
       google.maps.event.trigger(map, "resize");
       map.setCenter(center); 
       displayClusterMap();
    }
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
                          <li >
                          <a href="./" class="auto">                                                        
                            <i class="i i-dot"></i>
                            <span>Punch IN/OUT</span>
                          </a>
                        </li>
                        <li class='active'>
                          <a href="./clusterlead" class="auto">                                                        
                            <i class="i i-dot"></i>
                            <span>View Cluster</span>
                          </a>
                        <li class='active'>
                          <a href="./reporting" class="auto">                                                        
                            <i class="i i-dot"></i>
                            <span>Reporting</span>
                          </a>
                        </li>                          
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
                  

                  <?php echo form_open('map/show_result', array('target'=>'_blank', 'id'=>'myform'))?>
                  <div class='row'>
                      <div class="col-md-12">
                      <section class="panel b-a">
                        <div class="panel-heading b-b">
                          <a href="#" class="font-bold">Mapping Activities</a>
                          <input type="hidden" name="userlevel" id="userLevel" value="<?php echo $userLevel;?>">
                          <input type="hidden" name="defaultuserid" id="defaultuserid" value="<?php echo $userid;?>">
                        </div><br>
                          <div class="table-responsive">
                            <div id="status_filter" class='col-sm-12'>
                              <div class='form-group'>
                              
                              
                              
                              <div class="col-md-2">  
                                <label>Show</label>
                              <select id="category" name="category" class="form-control">
                                <option value="1">All</option>
<!--                                <option value="2">LateIn punch</option>
                                <option value="3">EarlyOut Punch</option>-->
                                <!-- <option value="4">Punch Anomaly</option>                               -->

                                <!-- <option value="3">Insufficient Hours</option>
                                <option value="4">Both Late/Early and Insufficient Hours</option>
                                <option value="5">Punch Anomaly</option>
                                <option value="6">No Attendance Problem</option> -->
                              </select>
                            </div>
                              <!-- <input id="remarks" type="checkbox" value="1" name="remarks">Remarks</input> -->
                              <div class="col-md-2">
                              <label>From</label>
                              <?php 
                                $data = array(
                                          'name'        => 'dateFrom',
                                          'value'       => "".date('d-m-Y', strtotime(date('d-m-Y')))."",
                                          // 'class'       => 'input-sm input-s datepicker-input form-control',
                                          'class'       => 'datepicker-input form-control',
                                          'id'          => 'dateFrom',
                                          'data-date-format'    => 'dd-mm-yyyy'
                                  );
                                echo form_input($data);
                                ?>    
                              </div>
                              <div class="col-md-2">
                              <label>Until</label>
                              <?php 
                                $data = array(
                                          'name'        => 'dateTo',
                                          'value'       => "".date('d-m-Y', strtotime(date('d-m-Y')))."",
                                          'class'       => 'idatepicker-input form-control',
                                          'id'          => 'dateTo',
                                          'data-date-format'    => 'dd-mm-yyyy'
                                  );
                                echo form_input($data);
                                ?>
                              </div>

                              <div class="col-md-2">
                                <label>For</label>

                                <?php if($userLevel==99){ 
                                        //echo "Administration Mode";
                                        $options = array(
                                          
                                          '1'  => 'All Pi1M Managers',
                                          '2'  => 'All Nusuara Staff',
                                          '3'  => 'Region',
                                          '4' => 'Cluster',
                                          '5' => 'Pi1M Site',
                                          '6' => 'Manager',
                                          //'7' => 'Staff',
                                        );
                                      }

                                  else if($userLevel == 3 ){ 
                                      //echo "Cluster Lead";
                                      $options = array(
                                    
                                        '1'  => 'All Pi1M Managers',
                                        //'2'  => 'All Nusuara Staff',
                                        //'3'  => 'Region',
                                        '4' => 'Cluster',
                                        '5' => 'Pi1M Site',
                                        '6' => 'Manager',
                                        //'7' => 'Staff',
                                      ); 
                                  }

                                  else if($userLevel == 4 ){ 
                                      //echo "Operation Manager";
                                      $options = array(
                                    
                                        '1'  => 'All Pi1M Managers',
                                        '2'  => 'All Nusuara Staff',
                                        '3'  => 'Region',
                                        '4' => 'Cluster',
                                        '5' => 'Pi1M Site',
                                        '6' => 'Manager',
                                        //'7' => 'Staff',
                                      ); 
                                  }
                              ?>
                              <?php 

                                echo form_dropdown('forpi1m', $options, '', 'id="forpi1m" name="forpi1m" class="form-control"');


                                ?> 
                                 
                              </div>

                                <div id="region_div" class='col-md-2' style="display:none;">
                                  
                                    <label>Region</label>
                                    
                                    <?php 
                                      $options = array(
                                          '1' => 'All',
                                          '2' => 'Peninsular',
                                          '3' => 'Sabah/Sarawak',
                                        );
                                      echo form_dropdown('region', $options, '', 'id="region" name="region" class="form-control"');


                                      ?>                    
                                </div> 

                                <div id="cluster_div" class='col-md-2' style="display:none">
                                  <div class='form-group'>
                                    <label>Cluster</label>
                                    
                                    <?php 
                                      echo form_dropdown('cluster', $cluster_list, '', 'id="cluster" name="cluster" class="form-control"');
                                      ?>

                                  </div>                            
                                </div> 

                                <div id="site_div" class='col-md-4' style="display:none">
                                    
                                      <label>Site</label>
                                      
                                      <?php 
                                        $data = array(
                                                  'name'        => 'sitename',
                                                  'value'       => "",
                                                  //'class'       => 'input-sm input-s datepicker-input form-control',
                                                  'id'          => 'sitename',
                                                  'size'        => 50,
                                                  'class'       => 'form-control',

                                          );
                                        //$js = 'onclick="participants.searchByObj(this)"';
                                        echo form_input($data);

                                        $dataid = array(
                                                  'name'        => 'siteid',
                                                  'value'       => "",
                                                  //'class'       => 'input-sm input-s datepicker-input form-control',
                                                  'id'          => 'siteid',
                                                  'type'        => 'hidden',

                                          );                                
                                        echo form_input($dataid);
                                        ?>

                                                               
                                  </div>
                                  <div id="manager_div" class='col-md-4' style="display:none">
                                      <label>Manager</label>
                                      
                                      <?php 
                                        $data = array(
                                                  'name'        => 'username',
                                                  'value'       => "",
                                                  //'class'       => 'input-sm input-s datepicker-input form-control',
                                                  'id'          => 'username',
                                                  'size'        => 50,
                                                  'class'       => 'form-control'

                                          );
                                        //$js = 'onclick="participants.searchByObj(this)"';
                                        echo form_input($data);

                                        $dataid = array(
                                                  'name'        => 'userid',
                                                  'value'       => "",
                                                  //'class'       => 'input-sm input-s datepicker-input form-control',
                                                  'id'          => 'userid',
                                                  'type'        => 'hidden',

                                          );                                
                                        echo form_input($dataid);
                                        ?>
                           
                                  </div>                                  
                            </div>

                          </div>

                          <!-- <div class="clearfix"></div> -->

                          <!-- <div id="datefrom_div" class='col-sm-12'> -->
                            <!-- <div class='form-group'> -->


                            <!-- </div> -->

                         <!-- <div class="clearfix"></div> -->

                        <!-- </div> -->

                          <div id="dateto_div" class='col-sm-12'>
                            <div class='form-group'>


                            </div>                            
                          </div>
                         
                     

                           

                         <div class="clearfix"></div>

                          <div class='form-group' class='col-sm-12'>
                                <?php //echo form_submit('mysubmit', 'Show Report', 'class="btn btn-primary"'); ?>
                                <input type="button" id="submitbtn" value="Find It!" class="btn btn-primary">
                          </div>

                          <!-- <div id="submitbtn" class='col-sm-12'> -->
                            
                          <!-- </div> -->

                       

                        </div>
                        <div id="testdiv"></div>
                          <div class="table-responsive">

                              <table id="tableClusterLeadMap" class="table table-striped m-b-none">
                              <!--<table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">-->
                              </table>
                            </div>   
                            <div class="clearfix panel-footer">                        
                      </section>
                          <!-- map modal -->
                        
                        <div id="locateClusterMap" class="modal fade" tabindex="-1" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="checkbox" class="close" data-dismiss="modal" id="canceloutstation_X">×</button>
                                            <h4 style="text-align: center">Geolocation Maps</h4>
                                        </div>
                                        
                                        <div class="modal-body">
                                            <div id="map_canvas" class="" style="width:560px; height:350px;"></div>
                                            
                                        </div>
                                        <div class="modal-footer">
                                            <a href="#" class="btn btn-primary" data-dismiss="modal" >Close</a>
                                            
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <!-- end map modal-->
<!--                <table>
                  <tr>
                <td class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Tooltip on top"></td>
              </tr>
            </table>-->
                                                                      
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
