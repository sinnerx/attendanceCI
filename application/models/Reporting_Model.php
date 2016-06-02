<?php
defined ('BASEPATH') OR exit('No direct access allowed!');

//birds_model.php (Array of Objects)
class Reporting_model extends CI_Model{

  //protected $table = 'site';
  private $datatables;

  public function get_list_site($q,$userid, $userlevel){
    //print_r("test get_list_site");
    if ($userlevel == 3){
        $this->db->select("cluster_lead.clusterID, clusterName");
        $this->db->where('cluster_lead.userID', $userid);
        $this->db->join('cluster','cluster_lead.clusterID = cluster.clusterID');
        $result = $this->db->get('cluster_lead');

        //$result = $result->result_array();
          $return = array();
          $arraySite = array();
          $x = 0;
          $in_string = '(';
          foreach($result->result_array() as $row) {
            //$return[$x][$row['clusterID']] = $row['clusterName'];
            //$return[$row['clusterID']] = $row['clusterName'];

            $this->db->where('clusterID', $row['clusterID']);
            $resultsite = $this->db->get('cluster_site')->result_array();
            
            foreach ($resultsite as $keySite) {
              # code...
              array_push($arraySite, $keySite["siteID"]);
            }
              $in_string .= implode(", ", $arraySite);
              
            //$x++;

          }
              $in_string .= ")";
              //print_r($in_string);
              //die; 
        
    }
    else  if ($userlevel == 99){
      //if ($userlevel == 99){
      $arrayCluster = array('1', '2', '3', '4', '5', '6');

      foreach($arrayCluster as $row) {
            //$return[$x][$row['clusterID']] = $row['clusterName'];
            //$return[$row['clusterID']] = $row['clusterName'];

            $this->db->where('clusterID', $row['clusterID']);
            $resultsite = $this->db->get('cluster_site')->result_array();
            $arraySite = array();
            foreach ($resultsite as $keySite) {
              # code...
              array_push($arraySite, $keySite["siteID"]);
            }
              //$in_string .= implode(", ", $arraySite);
              
            //$x++;

          }

    }


    $this->db->select('siteID, siteName');
    $this->db->like('siteName', $q);

    if ($userlevel == 3 || userlevel == 99)
      $this->db->where_in('siteID', $arraySite);
    
    $query = $this->db->get('site');
    if($query->num_rows() > 0){
      foreach ($query->result_array() as $row){
        $new_row['label']=htmlentities(stripslashes($row['siteName']));
        $new_row['value']=htmlentities(stripslashes($row['siteID']));
        $row_set[] = $new_row; //build an array
      }
      echo json_encode($row_set); //format the array into json data
    }
  }

  public function get_list_user($q){
    $this->db->select('user.userID, userProfileFullName AS userName');
    $this->db->like('userProfileFullName', $q);
    $this->db->join('user_profile', 'user.UserID = user_profile.userID');
    $this->db->where('user.userLevel <>', '1');
    $query = $this->db->get('user');

    //print_r($query);
    if($query->num_rows() > 0){
      foreach ($query->result_array() as $row){
        $new_row['label']=htmlentities(stripslashes($row['userName']));
        $new_row['value']=htmlentities(stripslashes($row['userID']));
        $row_set[] = $new_row; //build an array
      }
      echo json_encode($row_set); //format the array into json data
    }
  }  



  public function getClusterByUserID($id){
    //echo $id;
    $this->db->select("cluster_lead.clusterID, clusterName");
    $this->db->where('cluster_lead.userID', $id);
    $this->db->join('cluster','cluster_lead.clusterID = cluster.clusterID');
    $result = $this->db->get('cluster_lead');

    //$result = $result->result_array();
      $return = array();
      $x = 0;
      foreach($result->result_array() as $row) {
        //$return[$x][$row['clusterID']] = $row['clusterName'];
        $return[$row['clusterID']] = $row['clusterName'];
        $x++;
      }    
    //$result = $result->id;
      //$this->db->stop_cache();
      //$this->db->flush_cache();
    return $return;
       // return 'abc';
  }

  public function get_cluster($regionid = null)
    {
      //$this->db->from('city');
      $this->db->select('clusterID, clusterName');
      //$this->db->order_by('clusterName');

      if($regionid == 2){
        $arrayCluster = array('5', '6');
      }
      else if ($regionid == 3){
        $arrayCluster = array('1', '2', '3', '4');        
      }
      else
        $arrayCluster = array('1', '2', '3', '4', '5', '6');  

      $this->db->where_in('clusterID', $arrayCluster);
      $result = $this->db->get('cluster');
      $return = array();
      $x = 0;
      if($result->num_rows() > 0) {
        $return[''] = 'No Cluster';
      foreach($result->result_array() as $row) {
        //$return[$x][$row['clusterID']] = $row['clusterName'];
        $return[$row['clusterID']] = $row['clusterName'];
        $x++;
      }

    }  
    //return $result;
    return $return;
  }

  private function _get_datatables_query($datapost = null)
    {
      $clusterLocal = $this->getClusterByUserID($datapost['defaultuserid']);
                //print_r($datapost);
                //die;
                //$this->db->where('clusterID', 5);
                //$query = $this->db->from('att_attendancedetails');
                //print_r($query);
                // = $this->db->get('att_attendancedetails');
        $this->db->select("managerID, managerName, siteName, activityDateTime, activityStatus, outstationStatus, attendanceStatus, latLongIn, latLongOut, hours, lateIn, earlyOut, anomaly, siteID, att_attendancedetails.clusterID as clusID, DATE(activityDateTime) as dateonly, TIME(activityDateTime) as timeonly");
        $this->db->from('att_attendancedetails');
        // {
        // dateFrom: "30-01-2016",
        // dateTo: "06-01-2016",
        // forpi1m: "1",
        // region: "1",
        // cluster: "1",
        // sitename: "",
        // siteid: "",
        // username: "",
        // userid: "",
        // mysubmit: "Submit Post!"
        // },

        //if(){}
            // <option value="1">All</option>
            // <option value="2">Late/Early punch</option>
            // <option value="3">Insufficient Hours</option>
            // <option value="4">Both Late/Early and Insufficient Hours</option>
            // <option value="5">Punch Anomaly</option>
            // <option value="6">No Attendance Problem</option>

        $this->db->where('attendanceStatus <>', "");
        // if($datapost['category'] != ''){
        //   if($datapost['category'] == 1) {
        //       // $this->db->where('lateIn', 1);
        //       // $this->db->where('hours <=', 8);
        //       // $this->db->where('anomaly', 1);              
        //   }
        //   else if($datapost['category'] == 2) {
        //       $this->db->where('lateIn', 1);
        //   }
        //   else if($datapost['category'] == 3) {
        //       $this->db->where('hours <=', 8);
        //   }   
        //   else if($datapost['category'] == 4) {
        //       $this->db->where('lateIn', 1);
        //       $this->db->where('hours <=', 8);
        //   }                  
        //   else if($datapost['category'] == 5) {
        //       $this->db->where('anomaly', 1);
        //   }             
        //   else if($datapost['category'] == 6) {
        //       $this->db->where('lateIn', 0);
        //       $this->db->where('hours >=', 8);
        //       $this->db->where('anomaly', 0);
        //   }            
        // }//if category

        if($datapost['cluster'] != '')
          $this->db->where('clusterID', $datapost['cluster']);

        if($datapost['forpi1m'] != ''){
              // '1'  => 'All Pi1M Managers',
              // '2'    => 'All Nusuara Staff',
              // '3'   => 'Region',
              // '4' => 'Cluster',   
              $this->db->join('user', 'managerID = user.userID');      
          if ($datapost['forpi1m'] == '1'){
              $this->db->where('userLevel', '2');
              if ($datapost['userlevel'] == 3){
                //print_r($datapost['userid']);
                //die;
                $this->db->where('att_attendancedetails.clusterID', key($clusterLocal));
                
                //print_r($this->db->last_query());
                //die;
              }//if userlevel = 3
              
            //else if ($datapost['userLevel'] == 2)
            //  $this->db->where('managerID', $datapost['cluster']);
          }
            

          else if ($datapost['forpi1m'] == '2')
            $this->db->where_in('userLevel', array('3','4'));

        }//if pi1m

        if ($datapost['region'] != ''){
            $regionid = $datapost['region'];
          if($regionid == 2){
            $arrayCluster = array('5', '6');
          }
          else if ($regionid == 3){
            $arrayCluster = array('1', '2', '3', '4');        
          }
          else
            $arrayCluster = array('1', '2', '3', '4', '5', '6');  

          //$this->db->join('cluster AS c', 'c.clusterID = att_attendancedetails.clusterID');
          $this->db->where_in('att_attendancedetails.clusterID', $arrayCluster);

        }//if region


        if ($datapost['siteid'] != ''){

            $this->db->where('siteID', $datapost['siteid']);
        }//if siteid

        if ($datapost['userid'] != '')
            $this->db->where('managerID', $datapost['userid']);

        $datefrom = date('Y-m-d', strtotime($datapost['dateFrom']));
        $dateto   = date('Y-m-d', strtotime($datapost['dateTo']));

        // $this->db->where('activityDateTime >=', $datefrom);
        // $this->db->where('activityDateTime <=', $dateto);
           $this->db->where('DATE(activityDateTime) BETWEEN "'. $datefrom . '" AND "'. $dateto .'"');

        $fields = $this->db->list_fields('att_attendancedetails');
        $fields = array_diff($fields,array("activityDate", "activityTime"));
        //print_r($fields);
        //die;
        $i = 0;
    
        if(isset($_GET['search']['value']))
          $search = $_GET['search']['value'];

        if(isset($_GET['order']))
          $order  = $_GET['order'];

        $order_default = array('attID' => 'desc'); // default order 
        foreach ($fields as $item) // loop column 'attID','managerID','managerName','siteName','activityDate','activityTime','activityStatus','outstationStatus', 'latLongIn'

        {

            if($item == 'userEmail')
              $item = 'user.userEmail';

            if(isset($search)) // if datatable send POST for search
            {
                
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $search);
                }
                else
                {
                    $this->db->or_like($item, $search);
                }

                if(count($fields) - 3 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $fields[$i] = $item; // set column array variable to order processing
            $i++;
        }
        
        if(isset($order)) // here order processing
        {
            $this->db->order_by($fields[$_GET['order']['0']['column']], $_GET['order']['0']['dir']);
        } 
        else if(isset($order_default))
        {
            $order = $order_default;
            $this->db->order_by(key($order), $order[key($order)]);
        }
        //else{
          //$this->db->order_by('dateonly','asc');
        //}
    }


    public function get_datatables($datapost = null)
    {
        //var_dump('from model-get_datatables'.$datapost['cluster']);
                //$this->db->where('managerID',134);
        //print_r($datapost);
        //die;



        $this->datatables = $datapost;


        
        $this->_get_datatables_query($this->datatables);
        //$this->db->where('clusterID', $datapost['cluster']);
                //$this->db->query(select managerID from att_attendancedetails where managerID in (SELECT userID FROM site_manager WHERE siteID IN (SELECT siteID FROM cluster_site WHERE clusterID = 1)));
        //if (isset($_GET['length']))
          $length = $_GET['length'];

        //if (isset($_GET['start']))
          $start = $_GET['start'];
        //$this->db->limit(10, 0);
        //print_r($length)
        if($length != -1)
        $this->db->limit($length, $start);
        
                //$this->db->from($this->table);
        //$this->db->where('managerID',$id);
                //$query = $this->db->query("select managerID from att_attendancedetails where managerID in (select userID from site_manager where siteID in (select siteID from cluster_site where clusterID = 1))");
        $query = $this->db->get();
        //print_r($this->db->last_query());
        //die;
        //print_r($query->result());
        //die;
        return $query->result();
    }

    public function count_filtered()
    {
        $this->_get_datatables_query($this->datatables);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from('att_attendancedetails');
        return $this->db->count_all_results();
    }

    //for test function purposes
    public function display_result(){
        $this->db->from('att_attendancedetails');
        $this->db->select("*");
        //$this->db->where('clusterID', 64);
        $query = $this->db->get();

        $fields = $this->db->list_fields('att_attendancedetails');

        //return $query->result();
        foreach ($fields as $value) {
          # code...
          //echo $value;
        }

        return $fields[0];


    }

    public function updateDate(){
        $this->db->from('att_attendancedetails');
        $this->db->select("*");
        $query = $this->db->get()->result();
        //print_r($query);
        foreach ($query as $key) {
          # code...
          //print_r(date('Y-m-d H:i:s ' , strtotime($key->activityDate . " " .$key->activityTime)));
          $newdatetime = date('Y-m-d H:i:s ' , strtotime($key->activityDate . " " .$key->activityTime));
          $this->db->set('activityDateTime', $newdatetime);
          $this->db->where('attID', $key->attID);
          $this->db->update('att_attendancedetails');
        }
        //print_r($query);
        //die;
    }

    public function get_listattendance_arranged($datapost = null)
    {

        //print_r($datapost);
        //die;
        $this->datatables = $datapost;

        $dateSelected = $this->getDateSelected($datapost);
        //print_r($dateSelected);        

        $userSelected = $this->getUserSelected($datapost);
        //print_r($userSelected);
        //die;

        $this->_get_datatables_query($datapost);
        $queryResult = $this->db
        
        ->get()
        ->result_array();
        //->last_query();
      
        //print_r($queryResult);
        //die;
        
        $resultArray = array();
        $x = 0;
        foreach ($dateSelected as $keyDate) {
          # code...
            //print_r($keyDate['dateonly']);
              //$dateArray = array();
            //$resultArray[$x]['fordate'] = $keyDate['dateonly'];
            foreach ($userSelected as $keyUser) {
              # code...
                $columnArray = array();
                //print_r($keyUser['managerName']);
                //send $keyDate["dateonly"], using LIKE 
                //& $keyUser["userid"]
                    $columnArray['membername'] = $keyUser['managerName'];
                    $columnArray['in1'] = '';
                    $columnArray['out1'] = '';
                    $columnArray['in2'] = '';
                    $columnArray['out2'] = '';

                foreach ($queryResult as $keyQuery) {
                  # code...
                  //print_r($keyQuery);

                  if($keyDate['dateonly'] == $keyQuery['dateonly'] ){
                      //print_r($keyDate['dateonly']);
                      $columnArray['date'] = $keyQuery['dateonly'];

                      if ($keyQuery['attendanceStatus'] == 'in1' && $keyUser['managerID'] == $keyQuery['managerID']){
                         $columnArray['in1'] = $keyQuery['timeonly'];
                         if($keyQuery['lateIn'] == 1){
                            $columnArray['lateIn1'] = "x";
                            $columnArray['note'] = $keyQuery['outstationStatus'];
                         } 
                          elseif($keyQuery['lateIn'] == 0 && $keyUser['managerID'] == $keyQuery['managerID'])
                            $columnArray['lateIn1'] = "";
                      }//if in1

                      else if ($keyQuery['attendanceStatus'] == 'in2' && $keyUser['managerID'] == $keyQuery['managerID']){
                          $columnArray['in2'] = $keyQuery['timeonly'];
                          if($keyQuery['lateIn'] == 1){
                             $columnArray['lateIn2'] = "x";
                             $columnArray['note'] = $keyQuery['outstationStatus'];
                          }

                          elseif($keyQuery['lateIn'] == 0 && $keyUser['managerID'] == $keyQuery['managerID'])
                            $columnArray['lateIn2'] = "";                                                   
                      }//else if in2

                      else if ($keyQuery['attendanceStatus'] == 'out1' && $keyUser['managerID'] == $keyQuery['managerID']){
                          $columnArray['out1'] = $keyQuery['timeonly'];
                          if($keyQuery['earlyOut'] == 1){
                             $columnArray['earlyOut1'] = "x";
                             $columnArray['note'] = $keyQuery['outstationStatus'];
                          }
                          elseif($keyQuery['earlyOut'] == 0 && $keyUser['managerID'] == $keyQuery['managerID'])
                            $columnArray['earlyOut1'] = "";                                                   
                      }//else if out1

                      else if ($keyQuery['attendanceStatus'] == 'out2' && $keyUser['managerID'] == $keyQuery['managerID']){
                          $columnArray['out2'] = $keyQuery['timeonly'];
                          if($keyQuery['earlyOut'] == 1){
                             $columnArray['earlyOut2'] = "x";
                             $columnArray['note'] = $keyQuery['outstationStatus'];
                          }
                          elseif($keyQuery['earlyOut'] == 0 && $keyUser['managerID'] == $keyQuery['managerID'])
                            $columnArray['earlyOut2'] = "";                                                    
                      }//else if out2

                      //$columnArray['note'] = $keyQuery['outstationStatus'];

                      if($keyQuery['anomaly'] == 1 && $keyUser['managerID'] == $keyQuery['managerID']){
                        //echo " ANOMALIES ";
                        $columnArray['anomaly'] = "x";
                        $columnArray['note'] = $keyQuery['outstationStatus'];
                      }
                      elseif ($keyQuery['anomaly'] == 0 && $keyUser['managerID'] == $keyQuery['managerID']) 
                        $columnArray['anomaly'] = "";
                      //echo " nonanomaly ";

                      

                  }//if dateonly
                  //print_r($keyQuery);
                  
                }//foreach query
                //print_r($columnArray);
                //check status flag
                //$resultArray[$x] = $columnArray;
                if($datapost['category'] != ''){
                  if($datapost['category'] == 1) {
                      // $this->db->where('lateIn', 1);
                      // $this->db->where('hours <=', 8);
                      // $this->db->where('anomaly', 1); 
                      $resultArray[$x] = $columnArray;             
                  }
                  else if($datapost['category'] == 2) {
                      //$this->db->where('lateIn', 1);
                      if ($this->search($columnArray, 'lateIn1', 'x') == TRUE || $this->search($columnArray, 'lateIn2', 'x') == true)
                        $resultArray[$x] = $columnArray;
                  }
                  else if($datapost['category'] == 3) {
                      //$this->db->where('hours <=', 8);
                      if ($this->search($columnArray, 'earlyOut1', 'x') == TRUE || $this->search($columnArray, 'earlyOut2', 'x') == true)
                        $resultArray[$x] = $columnArray;                    
                  }   
                  else if($datapost['category'] == 4) {
                      //$this->db->where('lateIn', 1);
                      //$this->db->where('hours <=', 8);
                  }                  
                  else if($datapost['category'] == 5) {
                      //$this->db->where('anomaly', 1);
                  }             
                  else if($datapost['category'] == 6) {
                      //$this->db->where('lateIn', 0);
                      //$this->db->where('hours >=', 8);
                      //$this->db->where('anomaly', 0);
                  }
                }//if category  

                if( $columnArray['in1'] == "" && $columnArray['in2'] == "" && $columnArray['out1'] == "" && $columnArray['out2'] == ""){
                        $columnArray['anomaly'] = "";
                        unset($resultArray[$x]);
                      }              
               $x++; 
                //die;
            }//foreach user
                //$resultArray[$x]['attrow'] = $columnArray;





                               
                          

        }//foreach date
        //$resultArray = json_encode($resultArray);

        //print_r($resultArray);
        //die;



        return $resultArray;
    }

    public function getDateSelected($datapost = null)
    {
        //print_r($datapost);
        //die;


        $this->_get_datatables_query($datapost);
        //$this->db->where_in('managerid', )
        $this->db->group_by('dateonly');
        $queryDateSelected = $this->db->get()->result_array();
        //$dateSelected->group_by('dateonly');

        return $queryDateSelected;

    }

    public function getUserSelected($datapost = null)
    {
        $this->_get_datatables_query($datapost);
        $this->db->group_by('managerID');
        $queryUserSelected = $this->db->get()->result_array();
        //$dateSelected->group_by('dateonly');

        return $queryUserSelected;
    }

    public function search($array, $key, $value)
    {
        $results = array();
        $status = false;
        if (is_array($array)) {
            if (isset($array[$key]) && $array[$key] == $value) {
                $results[] = $array;
                $status = true;
            }

            // foreach ($array as $subarray) {
            //     $results = array_merge($results, $this->search($subarray, $key, $value));
            // }
        }

        //return $results;
        return $status;

        // $arr = array(0 => array(id=>1,name=>"cat 1"),
        //              1 => array(id=>2,name=>"cat 2"),
        //              2 => array(id=>3,name=>"cat 1"));
        //print_r(search($arr, 'name', 'cat 1'));
    }    

}