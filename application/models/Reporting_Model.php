<?php
defined ('BASEPATH') OR exit('No direct access allowed!');

//birds_model.php (Array of Objects)
class Reporting_Model extends CI_Model{

  //protected $table = 'site';
  private $datatables;

  public function get_list_site($q){
    $this->db->select('siteID, siteName');
    $this->db->like('siteName', $q);
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
                
                //$this->db->where('clusterID', 5);
                //$query = $this->db->from('att_attendancedetails');
                //print_r($query);
                // = $this->db->get('att_attendancedetails');
        $this->db->select("managerName, siteName, activityDate, activityTime, activityStatus, outstationStatus, attendanceStatus, latLongIn, latLongOut, hours, lateIn, earlyOut, anomaly, siteID, clusterID as clusID");
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
        if($datapost['category'] != ''){
          if($datapost['category'] == 1) {
              $this->db->where('lateIn', 1);
              $this->db->where('hours <=', 8);
              $this->db->where('anomaly', 1);              
          }
          else if($datapost['category'] == 2) {
              $this->db->where('lateIn', 1);
          }
          else if($datapost['category'] == 3) {
              $this->db->where('hours <=', 8);
          }   
          else if($datapost['category'] == 4) {
              $this->db->where('lateIn', 1);
              $this->db->where('hours <=', 8);
          }                  
          else if($datapost['category'] == 5) {
              $this->db->where('anomaly', 1);
          }             
          else if($datapost['category'] == 6) {
              $this->db->where('lateIn', 0);
              $this->db->where('hours >=', 8);
              $this->db->where('anomaly', 0);
          }            
        }

        if($datapost['cluster'] != '')
          $this->db->where('clusterID', $datapost['cluster']);

        if($datapost['forpi1m'] != ''){
              // '1'  => 'All Pi1M Managers',
              // '2'    => 'All Nusuara Staff',
              // '3'   => 'Region',
              // '4' => 'Cluster',   
              $this->db->join('user', 'managerID = user.userID');      
          if ($datapost['forpi1m'] == '1')
            $this->db->where('userLevel', '2');

          else if ($datapost['forpi1m'] == '2')
            $this->db->where_in('userLevel', array('3','4'));

        }

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

        }//


        if ($datapost['siteid'] != ''){

            $this->db->where('siteID', $datapost['siteid']);
        }

        if ($datapost['userid'] != '')
            $this->db->where('managerID', $datapost['userid']);

        $datefrom = date('d-m-Y', strtotime($datapost['dateFrom']));
        $dateto   = date('d-m-Y', strtotime($datapost['dateTo']));

        $this->db->where('activityDate >=', $datefrom);
        $this->db->where('activityDate <=', $dateto);

        $fields = $this->db->list_fields('att_attendancedetails');
 
        $i = 0;
    
        if(isset($_GET['search']['value']))
          $search = $_GET['search']['value'];

        if(isset($_GET['order']))
          $order  = $_GET['order'];

        $order_default = array('attID' => 'desc'); // default order 
        foreach ($fields as $item) // loop column 'attID','managerID','managerName','siteName','activityDate','activityTime','activityStatus','outstationStatus', 'latLongIn'

        {
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

                if(count($fields) - 1 == $i) //last loop
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
    }

    public function get_datatables($datapost = null)
    {
        //var_dump('from model-get_datatables'.$datapost['cluster']);
                //$this->db->where('managerID',134);
        //print_r($datapost);



        $this->datatables = $datapost;


        
        $this->_get_datatables_query($this->datatables);
        //$this->db->where('clusterID', $datapost['cluster']);
                //$this->db->query(select managerID from att_attendancedetails where managerID in (SELECT userID FROM site_manager WHERE siteID IN (SELECT siteID FROM cluster_site WHERE clusterID = 1)));
        $length = $_GET['length'];
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

}