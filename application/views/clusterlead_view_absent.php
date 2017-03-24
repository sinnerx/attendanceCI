<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script>

var AbsentStatus = {
   0 : "Not Justified", 
   3 : "Medical Certificate", 
   4 : "Training", 
   5 : "Off Day", 
   6 : "Annual Leave", 
   7 : "Emergency Leave", 
   8 : "Part Time", 
   9 : "Public Holiday",
   10 : "Internet Down",
};

var ApprovalStatus = {
   0 : "Not Justified", 
   1 : "Approved", 
};
var allFields = $( [] ).add( $("#punchinmorning") ).add( $("#punchoutnoon") ).add( $("#punchinnoon").add($("#punchoutevening")) );
var tips = $( ".validateTips" );
$(document).ready(function() {

$("input.timepicker").timepicki();  
      
     dialog = $( "#dialog-form" ).dialog({
          autoOpen: false,
          height: 400,
          width: 350,
          modal: true,
          buttons: {
            "Submit": submitInternetDown,
            Cancel: function() {
              dialog.dialog( "close" );
            }
          },
          close: function() {
            form[ 0 ].reset();
            allFields.removeClass( "ui-state-error" );
          }
        });
     
        form = dialog.find( "form" ).on( "submit", function( event ) {
          event.preventDefault();
          submitInternetDown();
        });

  $('#absent_table').DataTable({ 
        
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        "pagingType": "full_numbers",
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo base_url();?>clusterlead/ajax_absent_list",
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
            "targets": 4,
            "orderable": false,
            "render": function(dataA,type,row){
                                var disableColumn = "";
                                var displayIcon = "";
                                // console.log(row[5]);
                                if(row[5] != "0" ||row[6] == 1)
                                  disableColumn = "disabled";
                                else
                                  disableColumn = ""; 

                                //check if selection is internet down
                                if(row[4] == 10){
                                  displayIcon = "abc"
                                }

                                var $select = $("<select "+ disableColumn+"></select>", {
                                    "id": row[0],
                                    "class": 'sel_reason', 
                                    "onChange" : 'modifyManagerStatus(this,value)'
                                    // "value": data
                                });
                                $.each(AbsentStatus, function(k,v){
                                    var $option = $("<option></option>", {
                                        "text": v,
                                        "value": k
                                    });
                                    // console.log(dataA);
                                    // console.log(k);
                                    if(dataA === k){
                                        $option.attr("selected", "selected")
                                    }
                                    $select.append($option);
                                   
                                });
                                return $select.prop("outerHTML");

                            },

                         
        },
        {
            "targets": 5,
            "orderable": false,
            "searchable": true,
            "render": function(data,type,row){
                                var disableColumn = "";
                                // console.log(row[5]);
                                // if(row[5] != "0" || row[6] == 0)
                                if(row[5] == 1)
                                  disableColumn = "disabled";
                                else
                                  disableColumn = "";              
                                var $select = $("<select "+ disableColumn+"></select>", {
                                    "id": row[0],
                                    "class": 'sel_approve', 
                                    "dateRecord": row[1],
                                    "statusRecord": row[4],
                                    "onChange" : 'approveFunction(this,value)'
                                    // "value": data
                                });
                                $.each(ApprovalStatus, function(k,v){
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
                         
        },
        // {
        //     "targets": 6,
        //     "visible": true,
        //     "searchable": false,
        //     "render" : function(data,type,row){
        //       if(row[6] == 10){
        //         var $showLabel = $("<label name='viewbtn' onclick='displayTime()'>View</label>", {
        //                             // "value": data
        //                         });
        //           return $showLabel.prop("outerHTML");
        //       }//end if
        //       else{
        //         return "";
        //       }//end else
                
        //     },
        // },                
        ],
        "initComplete": function(settings, json) {
            // alert( 'DataTables has finished its initialisation.' );
            // $("#log_table select.sel_reason").on("change", "", function() {
            //         //console.log(json.data[0]);
            //     });            
            // function test(){
            //     //console.log('abc');
            // }


            this.api().columns([3,4,5]).every( function () {
                  var column = this;
                  // console.log(column[0][0]);
                  var columnNumber = {columnNumber:column[0][0]};
                  var select = $('<select><option value="">All</option></select>')
                      .appendTo( $(column.footer()).empty() )
                      .on( 'change', function () {
                          var val = $.fn.dataTable.util.escapeRegex(
                              $(this).val()
                          );
   
                          column
                              .search( val ? '^'+val+'$' : '', true, false )
                              .draw();
                      } );
                  //ajax populate dropbox
                  // console.log(columnNumber);
                  $.ajax({url: '<?php echo base_url()."/clusterlead/ajaxColumnAbsentFilter"; ?>', 
                      data : columnNumber,
                      method: "POST",
                      dataType: "json",
                      success: function(result){
                          //$("#div1").html(result);
                          // console.log(result);
                          $.each(result, function(index, result){
                            //console.log(index);
                            select.append( '<option value="'+index+'">'+result+'</option>' )
                          });
                          //populate option of the select
                  }});                  
                  // column.data().unique().sort().each( function ( d, j ) {
                  //     // console.log(column.data());
                  //     select.append( '<option value="'+d+'">'+d+'</option>' )
                  // } );
              } );    


          }  //end initComplete      

        //red row for late in eorly out
        // "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {

        //         }
        //alert($userid);
    });
});



function approveFunction(objselect, val){
    var id = $(objselect).attr('id');
    var dateRecord = $(objselect).attr('dateRecord');
    var managerStatusRecord = $(objselect).attr('statusRecord');
    // confirm("press");
    // console.log(id);
    console.log(managerStatusRecord);
    
    if (confirm('Confirm on this approval? (This approval cannot be undone.)')) {
        if(managerStatusRecord == 10){
        var updateData = {id:id, status:managerStatusRecord, dateR:dateRecord};
        // console.log('network down');
        dialog.data('param_1', updateData).dialog( "open" );
        // dialog.dialog( "open" );
        }
        else{
            var updateData = {id:id, status:val};
            $.ajax({url: '<?php echo base_url()."/clusterlead/approveAbsentStatus"; ?>', 
                data : updateData,
                method: "POST",
                success: function(result){
                    //$("#div1").html(result);
                    console.log(result);
                    $('#absent_table').DataTable().ajax.reload();
            }});           
        }
           
            // alert('Approval updated');     
    } else {
        // alert('Approval canceled');
        $(objselect).val($.data(objselect));
        // $.data(objselect, 'current', $(objselect).val());
        return false;
    }

       
}

function modifyManagerStatus(objselect, val){
  var id = $(objselect).attr('id');

      console.log(id);
      console.log(val);
      var updateData = {id:id, status:val};
      $.ajax({url: '<?php echo base_url()."/clusterlead/modifyManagerStatus"; ?>', 
          data : updateData,
          method: "POST",
          success: function(result){
              //$("#div1").html(result);
              console.log(result);
      }});  
}

// function displayTime(){
//   console.log('displaytime function');
// }
function submitInternetDown(){
      var valid = true;
      allFields.removeClass( "ui-state-error" );
      var datafromRow = $("#dialog-form").data('param_1');
      console.log(datafromRow.id);
      // valid = valid && checkLength( name, "username", 3, 16 );
      // valid = valid && checkLength( email, "email", 6, 80 );
      // valid = valid && checkLength( password, "password", 5, 16 );
 
      // valid = valid && checkRegexp( $("#punchinmorning"), /^([0-9:])+$/, "Enter time format only." );
      valid = valid && checkRegexp( $("#punchinmorning"), /^(0?[1-9]|1[012])(:[0-5]\d) [APap][mM]$/, "Enter time format only." );
      valid = valid && checkRegexp( $("#punchoutnoon"), /^(0?[1-9]|1[012])(:[0-5]\d) [APap][mM]$/, "Enter time format only." );
      valid = valid && checkRegexp( $("#punchinnoon"), /^(0?[1-9]|1[012])(:[0-5]\d) [APap][mM]$/, "Enter time format only." );
      valid = valid && checkRegexp( $("#punchoutevening"), /^(0?[1-9]|1[012])(:[0-5]\d) [APap][mM]$/, "Enter time format only." );
      
      // valid = valid && checkRegexp( name, /^[a-z]([0-9a-z_\s])+$/i, "Username may consist of a-z, 0-9, underscores, spaces and must begin with a letter." );
      // valid = valid && checkRegexp( email, emailRegex, "eg. ui@jquery.com" );
      // valid = valid && checkRegexp( password, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );
 
      if ( valid ) {
        // $( "#users tbody" ).append( "<tr>" +
        //   "<td>" + name.val() + "</td>" +
        //   "<td>" + email.val() + "</td>" +
        //   "<td>" + password.val() + "</td>" +
        // "</tr>" );
        //ajax submit
        var updateData = {id:datafromRow.id, punchinmorning:$("#punchinmorning").val(), punchoutnoon:$("#punchoutnoon").val(), punchinnoon:$("#punchinnoon").val(),punchoutevening:$("#punchoutevening").val()};
          $.ajax({url: '<?php echo base_url()."/manager/insertAttendanceFromAbsent"; ?>', 
                      data : updateData,
                      method: "POST",
                      success: function(result){
                          //$("#div1").html(result);
                          // console.log(result);
                          $('#absent_table').DataTable().ajax.reload();
          }});         
        dialog.dialog( "close" );
      }
      return valid;
}

function checkRegexp( o, regexp, n ) {
    
      if ( !( regexp.test( o.val() ) ) ) {
        o.addClass( "ui-state-error" );
        updateTips( n );
        return false;
      } else {
        return true;
      }
    }

function updateTips( t ) {
      console.log($( ".validateTips" ).text());
      //console.log(t);
      $( ".validateTips" ).text( t ).addClass( "ui-state-highlight" );
      setTimeout(function() {
        $( ".validateTips" ).removeClass( "ui-state-highlight", 1500 );
      }, 500 );
    }
</script>
    

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
          <a onclick="return true;" href="<?php echo base_url() . '../dashboard';?>" target="_self" style="border-left:1px dashed #CECECE;color: #8B8B8B;letter-spacing: 1px"><span class="btn btn-success">Go to Pi1M <span class="not-connected-text"></span></span></a>
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
              <a href="<?php echo base_url() . '../dashboard/user/profile';?>">My Profile</a>
            </li>
            <li>
              <a href="<?php echo base_url() . '../dashboard/user/changePassword';?>">Change Password</a>
            </li>
            <li class="divider"></li>
            <li>
              <a href="<?php echo base_url() . '../dashboard/logout';?>">Logout</a>
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
                        <li>
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
                        <li class='active'>
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
                      <h3 class="m-b-xs text-black"><?php echo $this->clusterlead_model->getClusterLeadGroup($userid); ?> Absence List</h3>
                      <!--<div class="well well-sm">All about your profile. You can edit all through here.</div>-->
                       <small>Welcome back, <?php echo $this->clusterlead_model->getFullName($userid)?>, <?php echo $this->clusterlead_model->getClusterLeadGroup($userid); ?><!--<i class="fa fa-map-marker fa-lg text-primary"></i>--> </small>
                    </div>
                  </section>
                  

                      
                  <div class='row'>
                      <div class="col-md-12">
                      <section class="panel b-a">
                        <div class="panel-heading b-b">
                          <a href="#" class="font-bold">Absence List</a>
                        </div><br>
                          <div class="table-responsive">
                              <table id="absent_table" class="table table-striped m-b-none display">
                              <!--<table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">-->
                                <thead>
                                  <tr>
                                    <th width="15%">ID</th>
                                    <th width="15%">Date</th>
                                    <th width="15%">Manager</th>
                                    <th width="15%">Site</th>
                                    <th width="20%">Status</th>
                                    <th width="20%">Approval</th>
                                  </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot><tr>
                                  <th></th>
                                  <th></th>
                                  <th></th>
                                  <th></th>
                                  <th></th>
                                  <th></th>
                                  </tr></tfoot>
                              </table>
                            </div>
                        <!-- map modal -->
                        
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
  <div id="dialog" title="Basic dialog">
  <p>This is the default dialog which is useful for displaying information. The dialog window can be moved, resized and closed with the 'x' icon.</p>
</div>

<div id="dialog-form" title="Enter Time for Punch In and Punch Out">
  <p class="validateTips">All form fields are required.</p>
 
  <form>
    <fieldset>
      <label for="name">Punch In (Morning)</label><br>
      <input type="text" name="punchinmorning" id="punchinmorning" value="" class="text ui-widget-content ui-corner-all timepicker"><br>
      <label for="email">Punch Out (Afternoon)</label><br>
      <input type="text" name="punchoutnoon" id="punchoutnoon" value="" class="text ui-widget-content ui-corner-all timepicker">  <br>    
      <label for="name">Punch In (Afternoon)</label><br>
      <input type="text" name="punchinnoon" id="punchinnoon" value="" class="text ui-widget-content ui-corner-all timepicker"><br>
      <label for="email">Punch Out (Evening)</label><br>
      <input type="text" name="punchoutevening" id="punchoutevening" value="" class="text ui-widget-content ui-corner-all timepicker"><br>
      <!-- Allow form submission with keyboard without duplicating the dialog button -->
      <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
    </fieldset>
  </form>
</div>
