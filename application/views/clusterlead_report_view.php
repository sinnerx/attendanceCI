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
        source: "reporting/get_site", // path to the get_birds method
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
        source: "reporting/get_user", // path to the get_birds method
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
            url : "reporting/get_cluster",
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
                url: 'reporting/get_clusterbyuser?'+ 'userid=' + '<?php echo $userid; ?>' + '&userlevel=' + '<?php echo $userLevel; ?>',
                
                success: function (data){
                    console.log(data);
                    $el = $("#cluster");
                    $el.empty();
                    $el.append($("<option></option>")
                            .attr("value", '').text('Please Select'));
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
            console.log($("form").serialize());
            console.log("<?php echo base_url() . 'reporting/attendance_list/?';?>" + $("form").serialize());
            $.ajax({
                type: 'GET',
                dataType: "json",
                url: 'reporting/attendance_list',
                data: $("form").serialize(),
                success: function(data) {
                    //alert(data);
                    var tableData = data;
                    console.log(tableData);
                    //$("#testdiv").text(tableData);
                    $('#tableClusterLeadReport').DataTable({ 
                        "data": tableData,
                        "bDestroy":true,
                        //"ajax": "reporting/attendance_list",
                        //"processing": true, //Feature control the processing indicator.
                        //"serverSide": true, //Feature control DataTables' server-side processing mode.
                        "order": [], //Initial no order.

                        // Load data for the table's content from an Ajax source
                        // "ajax": {
                        //     "url": "<?php echo base_url() . 'reporting/attendance_list/?' . $query;?>",
                        //     "type": "POST"
                        // },

                        //Set column definition initialisation properties.
                        "columns": [
                          {title : "Date" },
                          {title : "Name" },
                          {title : "In" },
                          {title : "Break Out" },
                          {title : "Break In" },
                          {title : "Out" },                          
                          {title : "Late In" },
                          {title : "Break Early Out" },
                          {title : "Break Late In" },
                          {title : "Early Out" },
                          // {title : "Note" },
                          {title : "Anomaly" },
                        ],

                        "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                            if ( aData[10] == "x" )
                            {
                                $('td', nRow).css('background-color', 'rgba(255, 0, 0, 0.23)');
                            }
                            else if ( aData[10] == "" )
                            {
                                //$('td', nRow).css('background-color', 'Orange');
                            }
                        }


                    });//end datatable

                }
            });
      });

 }); 
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
                  

                  <?php echo form_open('reporting/show_result', array('target'=>'_blank', 'id'=>'myform'))?>
                  <div class='row'>
                      <div class="col-md-12">
                      <section class="panel b-a">
                        <div class="panel-heading b-b">
                          <a href="#" class="font-bold">Activities</a>
                          <input type="hidden" name="userlevel" id="userLevel" value="<?php echo $userLevel;?>">
                        </div><br>
                          <div class="table-responsive">
                            <div id="status_filter" class='col-sm-12'>
                              <div class='form-group'>
                              
                              
                              
                              <div class="col-md-2">  
                                <label>Show</label>
                              <select id="category" name="category" class="form-control">
                                <option value="1">All</option>
                                <option value="2">LateIn punch</option>
                                <option value="3">EarlyOut Punch</option>
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
                                <input type="button" id="submitbtn" value="Show Report" class="btn btn-primary">
                          </div>

                          <!-- <div id="submitbtn" class='col-sm-12'> -->
                            
                          <!-- </div> -->

                       

                        </div>
                        <div id="testdiv"></div>
                          <div class="table-responsive">

                              <table id="tableClusterLeadReport" class="table table-striped m-b-none">
                              <!--<table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">-->
                              </table>
                            </div>   
                            <div class="clearfix panel-footer">                        
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
