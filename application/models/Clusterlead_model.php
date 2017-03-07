<?php
defined ('BASEPATH') OR exit('No direct access allowed!');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Clusterlead_model extends CI_Model{
    public $clusterID;
    //declare variable
    var $table = 'att_attendancedetails';
    var $column = array('attID','clusterID','managerID','managerName', 'siteID','siteName','activityDate','activityTime','activityStatus','outstationStatus', 'latLongIn','imgIn'); //set column field database for order and search
    var $order = array('attID' => 'desc'); // default order 
    //public $clusterLeadID = '';
        
    //construct
    public function __construct() {
        parent::__construct();
        //load db
        //$this->load->database();
    }
    public function getFullName($userid){
        $query = $this->db->query("SELECT userProfileFullName FROM user_profile WHERE userID ='$userid'");
        foreach ($query->result() as $row)
        {
                //return user fullname to view
               return $row->userProfileFullName;
        }
    }
    public function getSiteID ($userid){
        //get clustername from IRIS (siteName)
        $query = $this->db->query("SELECT site.siteID FROM site JOIN site_manager WHERE userID ='$userid' AND site.siteID = site_manager.siteID");
        foreach ($query->result() as $row)
        {
               //return cluster name/siteName to view
               return $row->siteID;
        }
    }
    public function getUserEmail ($userid){
        //get clustername from IRIS (siteName)
        $query = $this->db->query("SELECT userEmail FROM user WHERE userID ='$userid'");
        foreach ($query->result() as $row)
        {
               //return cluster name/siteName to view
               return $row->userEmail;
        }
    }
    public function getClusterName ($userid){
        //get clustername from IRIS (siteName)
        $query = $this->db->query("SELECT siteName FROM site JOIN site_manager WHERE userID ='$userid' AND site.siteID = site_manager.siteID");
        foreach ($query->result() as $row)
        {
               //return cluster name/siteName to view
               return $row->siteName;
        }
    }
    public function getClusterGroup ($userid){
        //get clustername from IRIS (siteName)
        //$query = $this->db->query("SELECT clusterName FROM cluster JOIN site_manager WHERE userID ='$userid' AND site.siteID = site_manager.siteID");
        $this->db->select('clusterName');
        $this->db->from('cluster'); 
        $this->db->join('cluster_site', 'cluster_site.clusterID = cluster.clusterID');
        $this->db->join('site_manager', 'cluster_site.siteID = site_manager.siteID');
        //$this->db->where('site_manager.userID = $userid',$userid);
        $this->db->where('site_manager.userID', $userid);
        $query = $this->db->get(); 
           
        foreach ($query->result() as $row)
        {
               //return cluster name/siteName to view
               return $row->clusterName;
        }
    }
    public function getClusterLeadGroup ($userid){
        //get cluster group name from IRIS (cluster/cluster_lead)
        $query = $this->db->query("SELECT clusterName FROM cluster JOIN cluster_lead WHERE userID = '$userid' AND cluster.clusterID = cluster_lead.clusterID");
        //$this->db->select('clusterName');
        //$this->db->from('cluster'); 
        //$this->db->join('clusterlead');
        //$this->db->where('userID', $userid);
        //$this->db->where('cluster.clusterID', 'cluster_lead.clusterID');
        //$where = "userID = '$userid' AND cluster.clusterID = cluster_lead.clusterID";
        //$this->db-where($where);
                
        //$query = $this->db->get(); 
           
        foreach ($query->result() as $row)
        {
               //return cluster name/siteName to view
               return $row->clusterName;
        }
    }
    public function getClusterLeadGroupID ($userid){
        //get cluster group name from IRIS (cluster/cluster_lead)
        $query = $this->db->query("SELECT cluster.clusterID FROM cluster JOIN cluster_lead WHERE userID = '$userid' AND cluster.clusterID = cluster_lead.clusterID");
        //$query = $this->db->get(); 
          
        foreach ($query->result() as $row)
        {
               //return cluster name/siteName to view
               return $row->clusterID;
        }
         
    }
   
    public function getSiteInCluster($idonly = null)
    {
        $this->db->select("CS.siteID, S.siteName");
        $this->db->from("cluster_site CS");
        $this->db->join("site S", "S.siteID = CS.siteID");
        $this->db->where("CS.clusterID", $this->getClusterLeadGroupID($this->userid));
        $result = $this->db->get()->result_array();

        $arraySite = array();
        foreach ($result as $key => $value) {
            // var_dump($value['siteID']);
            // die;
            # code...
            array_push($arraySite, $value['siteID']);
        }

        // var_dump($idonly);
        if($idonly === NULL){
            // var_dump('aaa');
            return $result;
        }
            
        else {
            // var_dump('bbb');
            return $arraySite;
        }
            
    }
   // public function setClusterLeadGroupID ($userid)
    //{
       // $query = $this->db->query("SELECT cluster.clusterID FROM cluster JOIN cluster_lead WHERE userID = '$userid' AND cluster.clusterID = cluster_lead.clusterID");
       // $query->getresult();
    //}
//    public function _get_clusterID(){
//                //$clusterID = $this->
//                        //select siteID from cluster_site where clusterID = 1
//                $this->db->select("siteID");
//                $this->db->from('cluster_site');
//                $this->db->where('clusterID',  1);
//                $subQueryClusterSite = $this->db->get_compiled_select();
//                //var_dump($subQueryClusterSite);
//                //select userID from site_manager where siteID
//                $this->db->select("userID");
//                $this->db->from('site_manager');
//                $this->db->where('siteID IN ('.$subQueryClusterSite. ')', NULL, FALSE);
//                $subQuerySiteManager = $this->db->get_compiled_select();
//                
//                //select managerID from att_attendancedetails where managerID
//                $this->db->select("managerID");
//                $this->db->from('att_attendancedetails');
//                $this->db->where('managerID IN ('.$subQuerySiteManager.')', NULL, FALSE);
//                $subQuerySiteManager = $this->db->get()->result(); 
//                //$subQuerySiteManager = $this->db->last_query();
//                return $subQuerySiteManager;
//    }
    private function _get_datatables_query()
	{
                $this->db->from($this->table);
                $this->db->where('clusterID', $this->getClusterLeadGroupID($this->userid));
 
		$i = 0;
	
		foreach ($this->column as $item) // loop column 'attID','managerID','managerName','siteName','activityDate','activityTime','activityStatus','outstationStatus', 'latLongIn'

		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                                        $this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$column[$i] = $item; // set column array variable to order processing
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
                //$this->db->where('managerID',134);
               $this->_get_datatables_query();
                //$this->db->query(select managerID from att_attendancedetails where managerID in (SELECT userID FROM site_manager WHERE siteID IN (SELECT siteID FROM cluster_site WHERE clusterID = 1)));
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
                //$this->db->from($this->table);
		//$this->db->where('managerID',$id);
                //$query = $this->db->query("select managerID from att_attendancedetails where managerID in (select userID from site_manager where siteID in (select siteID from cluster_site where clusterID = 1))");
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}
        
//        //isfirst in / latein catch here
//        public function isFirstInToday(){
//        //$this->db->select('activityDate');
//        $this->db->from('att_attendancedetails');
//        
//        $this->db->where('managerID', $this->userid);
//        $this->db->where('activityStatus !=', 'IN');
//        //isnnotdate
//        //$this->db->where('activityDate !=', date('d-m-Y'));
//        //isdate
//        $this->db->where('activityDate', date('d-m-Y'));
//        $query = $this->db->get();
//
//        
//        foreach ($query->result() as $row)
//            {
//                $row->activityDate;
//               // $row->activityTime;
//            }
//        $num = $query->num_rows();
//        //var_dump(empty($query));
//            //if in dont exist - its the first in
//            if ($num === 0){
//                $isFirstIn = 1;
//               // echo 'fisrtIn'.$isFirstIn;
//                }else{//is not the first in - possible anomaly
//                    $isFirstIn = 0;
//                   // echo 'fisrtIn'.$isFirstIn;
//            } 
//        //echo ' | '.date('H:i'); 
//             //print_r($row);
//        }
//        public function isFirstInYesterday(){
//        $this->db->from('att_attendancedetails');
//        $this->db->where('managerID', $this->userid);
//        $this->db->where('activityStatus', 'IN');
//        //isnnotdate
//        //$this->db->where('activityDate !=', date('d-m-Y'));
//        //isdate for yesterday
//        $yesterdayDate = date('d-m-Y', strtotime('-1 days'));
//        $this->db->where('activityDate', $yesterdayDate);
//        //echo '$yesterdayDate: '.$yesterdayDate;
//        //test on 29 jan 2016
//        //$this->db->where('activityDate', '29-01-2016');
//        $query = $this->db->get();
//        foreach ($query->result() as $row)
//            {
//                $row->activityDate;
//            }
//        $num = $query->num_rows();
//        //$num2 = $query->row();
//        $row = $query->first_row();
//        //$row = $query->row_array();
//        //print_r($row);
//        return $row;
//            
//        }
//        
//        //last out yesterday
//        public function isLastOutYesterday(){
//        $this->db->from('att_attendancedetails');
//        $this->db->where('managerID', $this->userid);
//        $this->db->where('activityStatus', 'OUT');
//        //isnnotdate
//        //$this->db->where('activityDate !=', date('d-m-Y'));
//        //isdate for yesterday
//        $yesterdayDate = date('d-m-Y', strtotime('-1 days'));
//        $this->db->where('activityDate', $yesterdayDate);
//        
//        //test on 29 jan 2016
//        //$this->db->where('activityDate', '29-01-2016');
//        $query = $this->db->get();
//        foreach ($query->result() as $row)
//            {
//                $row->activityDate;
//            }
//        $num = $query->num_rows();
//        //$num2 = $query->row();
//        $row = $query->last_row();
//        //$lastRow = $row;
//
//            //echo 'isLastOut[$num]'.$num; 
//            //if out no even and not more than 1
//            //if ($num % 2 === 0){
//            if ($num > 1){
//                $isLastOut = 1;
//                $isAnomaly = 0;
//                //echo '$isLastOut'.$isLastOut;
//                //echo '$isAnomaly'.$isAnomaly;
//                }else if($num ){
//                    $isLastOut = 0;
//                    $isAnomaly = 1;
//                    //echo '$isLastOut'.$isLastOut;
//                    //echo '$isAnomaly'.$isAnomaly;
//            }
//            //last row
//            //print_r($row);
//            return $row;
//        }
//        
//        public function hoursPerDay(){
//        
//        //total punch array/yesterday
//        $this->db->select('activityTime');    
//        $this->db->from('att_attendancedetails');
//        $this->db->where('managerID', $this->userid);
//        $yesterdayDate = date('d-m-Y', strtotime('-1 days'));
//        $this->db->where('activityDate', $yesterdayDate);
//        
//        //test on 29 jan 2016
//        //$this->db->where('activityDate', '29-01-2016');
//        $query = $this->db->get();
//        foreach ($query->result() as $row)
//            {
//                $row->activityTime;
//            }
//        $num = $query->num_rows();
//
//        $totalPunch = $num;
//        echo 'totalPunch: '.$num.' | ';
//            
//        //out
//        $this->db->select('activityTime');    
//        $this->db->from('att_attendancedetails');
//        $this->db->where('managerID', $this->userid);
//        $this->db->where('activityStatus', 'OUT');
//        //isnnotdate
//        //$this->db->where('activityDate !=', date('d-m-Y'));
//        //isdate yesterday
//        $yesterdayDate = date('d-m-Y', strtotime('-1 days'));
//        $this->db->where('activityDate', $yesterdayDate);
//        
//        //test on 29 jan 2016
//        //$this->db->where('activityDate', '29-01-2016');
//        $query = $this->db->get();
//        foreach ($query->result() as $row)
//            {
//                $row->activityTime;
//            }
//        //total punch-out
//        $numOut = $query->num_rows();
//        //$row = $query->last_row();
//        $rowOut = $query->row_array();
//        //echo ' | '.date('H:i'); 
//        //print_r($row);
//        $totalPunchOut = $num;
//            //echo 'totalPunchOut: '.$totalPunchOut;
//            //$numOut/In - no of punch out/in
//            for ($i = 0; $i < $numOut; $i++){
//               $rowOut = $query->row_array($i);
//               echo 'rowOut'.$i.': '.$rowOut['activityTime'].' | ';
//               $timeOut[$i] = $rowOut['activityTime'];
//
//            }
//        
//        //in
//        $this->db->select('activityTime');    
//        $this->db->from('att_attendancedetails');
//        $this->db->where('managerID', $this->userid);
//        $this->db->where('activityStatus', 'IN');
//        //isnnotdate
//        //$this->db->where('activityDate !=', date('d-m-Y'));
//        //isdate
//        $yesterdayDate = date('d-m-Y', strtotime('-1 days'));
//        $this->db->where('activityDate', $yesterdayDate);
//        
//        //test on 29 jan 2016
//        //$this->db->where('activityDate', '29-01-2016');
//        $query = $this->db->get();
//        foreach ($query->result() as $row)
//            {
//                $row->activityTime;
//            }
//         //total punch in   
//        $numIn = $query->num_rows();
//        //$row = $query->last_row();
//        $rowIn = $query->row_array();
//        //echo ' | '.date('H:i'); 
//        //$roww = $query->row(2);
//        //echo $rowIn[2];
//        //print_r($rowIn);
//        $totalPunchIn = $num;
//            //echo 'totalPunchIn: '.$totalPunchIn;
//            //$numOut/In - no of punch out/in
//            for ($i = 0; $i < $numIn; $i++){
//               $rowIn = $query->row_array($i);
//               echo 'rowIn'.$i.': '.$rowIn['activityTime'].' | ';
//               $timeIn[$i] = $rowIn['activityTime'];
//               
//            }
//            //calculate totalhour
//            $totalhour = 0;
//            //$totalhour1 = 0;
//            $firstIn = $this->isFirstInYesterday();
//            $firstIn = $this->isFirstInYesterday()->activityTime;
//            //if((strtotime($firstIn)- 9) >= 0){
//                for($i=0; $i < $numOut; $i++){
//
//                    $totalhour += ((strtotime($timeOut[$i]) - strtotime($timeIn[$i]))/3600);
//                }
//            //}
//            //echo 'fisrtIn: '.strtotime('09:00');
//            echo ' baki: '.(strtotime('09:00') - (strtotime($firstIn)));
//            $totalhour1 = ((strtotime($timeOut[0]) - strtotime($firstIn))/3600);  
//            echo 'totalhour1: '.$totalhour1;
//            echo 'totalhours: '.round($totalhour, 2);
//            
//            //insert to db
//            $this->db->set('hours', round($totalhour, 2));
//            $lastRow = $this->isLastOutYesterday();
//            $this->db->where('attID', $lastRow->attID);
//            echo 'lasthours: '.$lastRow->hours;
//            if($lastRow->hours == 0){
//                $this->db->update('att_attendancedetails');
//            }
//            //$this->db->insert();
//            //$firstIn = array();
//            
//           //print_r($firstIn);
//            echo $firstIn;
//            
//        }//end of hoursPerDay


    private function _get_datatables_query_absent()
    {
        $listSite = $this->getSiteInCluster(1);
        // var_dump($listSite);
        // die;
        // ID
        // Date
        // Manager
        // Site
        // Status
        // Approval
        //print_r($_POST);
        $this->db->select("MA.managerAttendanceID, MA.attendanceDate, CONCAT(COALESCE(userProfileFullName,''), ' ', COALESCE(userProfileLastName,'') ) as managerName, S.siteName, MA.attendanceStatus, MA.approvalStatus, AS.attStatusName, MA.approvalStatus ");
        $this->db->from('manager_attendance MA');
        $this->db->join('att_status AS', 'AS.attStatusID = MA.attendanceStatus');
        $this->db->join('site S', 'S.siteID = MA.siteID');
        $this->db->join('user_profile UP', 'UP.userID = MA.userID');
        //$this->db->where('managerID',$this->userid);
        $this->db->where_in('MA.siteID',$listSite);
        $this->db->where('MA.attendanceStatus !=',1); //dont display incomplete attendance

        //print_r($_POST['search']['value']);
        $i = 0;
        $column = array("MA.managerAttendanceID", "MA.attendanceDate", "UP.userProfileFullName", "UP.userProfileLastName", "S.siteName","MA.attendanceStatus", "MA.approvalStatus");


        // switch ($_POST['columns'][$x]['search']['value']) {
        //     case 'value':
        //         # code...
        //         break;
            
        //     default:
        //         # code...
        //         break;
        // }

        if($_POST['columns'][3]['search']['value']){
            $this->db->where("MA.siteID", substr($_POST['columns'][3]['search']['value'],1,-1));
        }        
        if($_POST['columns'][4]['search']['value']){
            $this->db->where("MA.attendanceStatus", substr($_POST['columns'][4]['search']['value'],1,-1));
        }        
        if($_POST['columns'][5]['search']['value']){
            $this->db->where("MA.approvalStatus", substr($_POST['columns'][5]['search']['value'],1,-1));
        }

        foreach ($column as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                                        $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($column) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $column[$i] = $item; // set column array variable to order processing
            $i++;
        }
        
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else
        {
            // $order = array(0=>'attendanceDate');
            $this->db->order_by('MA.attendanceDate', 'desc');
        }
    }

    function get_datatables_absent()
    {
                //$this->db->where('managerID',134);
                //$this->db->where('managerID',$this->userid);
        $this->_get_datatables_query_absent();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
                //$this->db->from($this->table);
        //$this->db->where('managerID',$id);
        $query = $this->db->get();
        return $query->result();
    }  

    public function count_filtered_absent()
    {
        $this->_get_datatables_query_absent();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_absent()
    {
        $listSite = $this->getSiteInCluster(1);
        $this->db->from('manager_attendance');
                //limit to userid
        $this->db->where_in('siteID',$listSite);
        return $this->db->count_all_results();
    }    

    
    public function approveAbsentStatus($data)
    {
        $id = $data['id'];
        $status = $data['status'];

        $this->db->set('approvalStatus', $status);
        $this->db->where('managerAttendanceID',  $id);
        $this->db->update('manager_attendance');        
    }     
}