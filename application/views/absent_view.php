<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script>

var times = {
   0 : "Not Justified", 
   1 : "Approved by CL", 
   2 : "Not Approved by CL", 
};

$(document).ready(function() {
  $('#log_table').DataTable({ 
        
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        //"pagingType": "full_numbers",
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo base_url();?>manager/ajax_absent_list",
            "type": "POST"
        },
         //Set column definition initialisation properties.
        "columnDefs": [
        {
            "targets": 0,
            "visible": false,
            "searchable": false,
        },
        { 
            
        //"targets": [ -1 ], //disable last column
        // "targets": [ 0,1 ], //disable sorting all column
        //     "orderable": false, //set not orderable

            "targets": 1,
            "orderable": true,
          
        },
        {
            "targets": 2,
            "orderable": false,
            "render": function(data,type,row){
                                var $select = $("<select ></select>", {
                                    "id": row[0],
                                    "class": 'sel_reason', 
                                    "onChange" : 'test(this,value)'
                                    // "value": data
                                });
                                $.each(times, function(k,v){
                                    var $option = $("<option></option>", {
                                        "text": v,
                                        "value": k
                                    });
                                    if(data === k){
                                        $option.attr("selected", "selected")
                                    }
                                    $select.append($option);
                                });
                                return $select.prop("outerHTML");
                            },
                         
        }
        ],
        "initComplete": function(settings, json) {
            // alert( 'DataTables has finished its initialisation.' );
            // $("#log_table select.sel_reason").on("change", "", function() {
            //         console.log(json.data[0]);
            //     });            
            function test(){
                console.log('abc');
            }
          }        

        //red row for late in eorly out
        // "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {

        //         }
        //alert($userid);
    });


});
function test(objselect, val){
    var id = $(objselect).attr('id');

    // console.log(id);
    // console.log(val);
    var updateData = {id:id, status:val};
    $.ajax({url: '<?php echo base_url()."/manager/updateAbsentStatus"; ?>', 
        data : updateData,
        method: "POST",
        success: function(result){
            //$("#div1").html(result);
            console.log(result);
    }});    
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
              <a href="../../dashboard/logout">Logout</a>
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
                  <?php if($userLevel == 2 || $userLevel == 7){ ?>
                  <ul class="nav nav-main" data-ride="collapse">
                      <li class="active">
                      <a href="#" class="auto">
                        <i class="i i-statistics icon">
                        </i>
                        <span class="font-bold">Attendance</span>
                      </a>
                      <ul class='nav dk'>
                          <li>
                          <a href="../" class="auto">                                                        
                            <i class="i i-dot"></i>
                            <span>Punch IN/OUT</span>
                          </a>
                        </li>
                        <li>
                          <a href="./viewLog" class="auto">                                                        
                            <i class="i i-dot"></i>
                            <span>View Log</span>
                          </a>
                        </li>
                        <li class='active' >
                          <a href="./viewAbsent" class="auto">                                                        
                            <i class="i i-dot"></i>
                            <span>View Absent</span>
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
                        echo "Manager's Absent Log";
                      }else if($userLevel==3){
                          echo "Cluster Lead's Attendance Log";
                      }else if($userLevel==4){
                          echo "Operation Manager's Attendance Log";
                      }else{
                          echo "Administration Attendance Log";
                      } ?></h3>
                      <!--<div class="well well-sm">All about your profile. You can edit all through here.</div>-->
                       <small>View manager's absent.</small>
                      
                    </div>
                  </section>
<!--                  <div id="cover">LOADING</div>-->
<!--                 <?php //echo form_open('manager'); ?> -->
                     
                  <section id='main' class="panel b-a">
                  <div ><!--class="table-responsive"-->
                              <table id="log_table" class="table table-striped m-b-none" data-ride="datatables">
                                <thead>
                                  <tr>
                                    <th width="15%">ID</th>
                                    <th width="15%">Date</th>
                                    <th width="20%">Status</th>
                                  </tr>
                                </thead>
                                <!--<tbody>
                                </tbody>-->
                             </table>
                            </div>
                  </section>
                
                
                <br/></p>
                </section>
              </section>
            <!--</section>-->            
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
      </section>
    </section>
  </section>

