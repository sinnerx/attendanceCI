<?php
defined ('BASEPATH') OR exit ('No direct access allowed!');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Manager_model extends CI_Model {
    var $table = 'att_attendancedetails';
    var $column = array('attID','clusterID','managerID','managerName', 'siteID','siteName','activityDate','activityTime', 'activityDateTime','activityStatus','outstationStatus', 'latLongIn', 'accuracy','imgIn'); //set column field database for order and search
    var $order = array('attID' => 'desc'); // default order 
    //construct
    public function __construct() {
        parent::__construct();

    }
    public function getFullName($userid){
       $query = $this->db->query("SELECT userProfileFullName FROM user_profile WHERE userID ='$userid'");
        foreach ($query->result() as $row)
        {
                //return user fullname to view
               return $row->userProfileFullName;
        }
    }
    
    public function getSiteName ($userid){
        //get clustername from IRIS (siteName)
        $query = $this->db->query("SELECT siteName FROM site JOIN site_manager WHERE userID ='$userid' AND site.siteID = site_manager.siteID");
        foreach ($query->result() as $row)
        {
               //return cluster name/siteName to view
               return $row->siteName;
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
    //get latest state of punch
    public function getLastPunchStatus($userid){
        $query = $this->db->query("SELECT activityStatus FROM att_attendancedetails WHERE managerID ='$userid'  ORDER BY  attID DESC");
        foreach ($query->result() as $row)
        {
               //return status
               return $row->activityStatus;
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
        
           
        foreach ($query->result() as $row)
        {
               return $row->clusterName;
        }
    }
    
    public function getClusterGroupID ($userid){
        //get cluster group name from IRIS (cluster/cluster_lead)
        $query = $this->db->query("SELECT cluster.clusterID FROM cluster JOIN site_manager JOIN cluster_site WHERE userID = '$userid' AND cluster.clusterID = cluster_site.clusterID AND cluster_site.siteID = site_manager.siteID"); 
        foreach ($query->result() as $row)
        {
               //return cluster name/siteName to view
               return $row->clusterID;
        }
    }
    public function getClusterLeadGroupID ($userid){
        //get cluster group name from IRIS (cluster/cluster_lead)
        $query = $this->db->query("SELECT cluster.clusterID FROM cluster JOIN cluster_lead WHERE userID = '$userid' AND cluster.clusterID = cluster_lead.clusterID");       
        foreach ($query->result() as $row)
        {
               //return cluster name/siteName to view
               return $row->clusterID;
        }
    }
    
    public function insertAttendance($data){
        $this->db->insert('att_attendancedetails',$data);
    }
    
    public function getAttendanceStatus(){
            $this->db->select('managerID,activityDate,attID');
            $this->db->from('att_attendancedetails');
            $this->db->where('managerID', $this->userid);
            $this->db->where('activityDate', date('d-m-Y'));
            $query = $this->db->get();
            foreach ($query->result() as $row)
                {
                    $row->attID;
               }
            $num = $query->num_rows();
            if ($num === 0){
                return 'in1';
                } 
            if( $num === 1){
                return 'out1';
                }
            if( $num === 2){
                return 'in2';
                }
            if( $num === 3){
                  return 'out2';   
                }
            }
            
        //isfirst in / latein catch here
        public function isFirstInToday(){
        //$this->db->select('activityDate');
        $this->db->select('managerID,activityDate');
        $this->db->from('att_attendancedetails');
        $this->db->where('managerID', $this->userid);
        //$this->db->where('activityStatus !=', 'IN');
        $this->db->where('activityDate', date('d-m-Y'));
        $query = $this->db->get();
        $num = $query->num_rows();
        if ($num === 0){
            return 'true';
            }else{
                return 'false';
            }
        }
        public function getAttQuery(){
            $this->db->select('managerID,activityDate');
            $this->db->from('att_attendancedetails');
            $this->db->where('managerID', $this->userid);
            $query = $this->db->get();
            return $query;
        }
        
        public function initAnomaly(){
            $query = $this->getAttQuery();
            if($query->num_rows() <> 0){
                $this->isAnomaly();
            }
        }
        
        public function isLastDay(){
                $query = $this->getAttQuery();
                $last = $query->last_row();
                $lastdate = $last->activityDate;
                return $lastdate;
        }
        public function isAnomaly(){
                $lastday = $this->isLastDay();
                $this->db->select('managerID,clusterID,managerName,siteID,siteName,userEmail,activityDate,attendanceStatus');
                $this->db->from('att_attendancedetails');
                $this->db->where('managerID', $this->userid);
                $this->db->where('activityDate', $lastday);
                $query = $this->db->get();
                $last = $query->last_row();
                $num = $query->num_rows();
                $row = $query->row($num-1);
                $date = $last->activityDate;
                $lastAtt = $last->attendanceStatus;
                if($date <> (date('d-m-Y'))){
                    if($num === 1){//if punch only once
                        //force punch out record
                        $data = array(
                            'managerID' => $last->managerID,
                            'clusterID' => $last->clusterID,
                            'managerName' => $last->managerName,
                            'siteID' => $last->siteID,
                            'siteName' => $last->siteName,
                            'userEmail' => $last->userEmail,
                            'activityDate' => $last->activityDate,
                            'activityTime' => '23:59',
                            'activityDateTime' => date('Y-m-d', strtotime($date)).' 23:59:59',
                            'activityStatus' => 'OUT',
                            //'outstationStatus' => '<i class="fa fa-warning" style="color:red;"></i><span style="color:red;"> Force punch activated by the system</span>',
                            'outstationStatus' => 'Force punch activated by the system',
                            'attendanceStatus' => 'out2',
                        );
                         $this->db->where('activityDate', $date);
                         $this->db->insert('att_attendancedetails', $data);
                         //set whole row flag for anomaly
                         $this->db->set('anomaly', 1);
                         $this->db->where('activityDate',  $date);
                         $this->db->where('managerID', $this->userid);
                         $this->db->update('att_attendancedetails');
                    }elseif($num === 2 && $lastAtt == 'out1'){//if punch only 2 times
                        //echo 'anomaly 2 !!!';
                        //flag anomaly

                    } elseif($num === 3){//if punch only 3 times
                        //echo 'anomaly 3 !!!';
                        $data = array(
                            'managerID' => $last->managerID,
                            'clusterID' => $last->clusterID,
                            'managerName' => $last->managerName,
                            'siteID' => $last->siteID,
                            'siteName' => $last->siteName,
                            'userEmail' => $last->userEmail,
                            'activityDate' => $last->activityDate,
                            'activityTime' => '23:59',
                            'activityDateTime' => date('Y-m-d', strtotime($date)).' 23:59:59',
                            'activityStatus' => 'OUT',
                            //'outstationStatus' => '<i class="fa fa-warning" style="color:red;"></i><span style="color:red;"> Force punch activated by the system</span>',
                            'outstationStatus' => 'Force punch activated by the system',
                            'attendanceStatus' => 'out2',
                            //'anomaly' => 1
                            
                        );
                        
                         $this->db->where('activityDate', $date);
                         $this->db->insert('att_attendancedetails', $data);
                         //set whole row flag for anomaly
                         $this->db->set('anomaly', 1);
                         $this->db->where('activityDate',  $date);
                         $this->db->where('managerID', $this->userid);
                         $this->db->update('att_attendancedetails');
                    } 
                }
        }
        
        public function isFourthPunched(){
                $this->db->select('managerID,activityDate');
                $this->db->from('att_attendancedetails');
                $this->db->where('managerID', $this->userid);
                $this->db->where('activityDate', date('d-m-Y'));
                $query = $this->db->get();                
                $num = $query->num_rows();
                //any punch more than 4 times
                if($num > 3){
                    return 'disabled';
                }else{
                    return '';
                }
        }
	function get_datatables_list($id)	
        {
        $this->db->select('managerID,activityStatus,activityDate,activityTime,latLongIn,outstationStatus');
        $this->db->from($this->table);
		$this->db->where('managerID',$id);
		$query = $this->db->order_by('attID','desc')->limit(28)->get();
		return $query->result();
	}
        
        function get_datatables_row_list($id)	
        {
        $this->db->select('managerID,activityStatus,activityDate,activityTime,latLongIn,outstationStatus');
        $this->db->from($this->table);
		$this->db->where('managerID',$id);
        $this->db->where('activityDate', date('d-m-Y'));
		$query = $this->db->get();
		return $query->num_rows();
	}

    private function _get_datatables_query()
    {
        //print_r($_POST);
                
        $this->db->from($this->table);
                //$this->db->where('managerID',$this->userid);
                $this->db->where('managerID',$this->userid);
                //print_r($_POST['search']['value']);
        $i = 0;
    
        foreach ($this->column as $item) // loop column 
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
                //$this->db->where('managerID',$this->userid);
                $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
                //$this->db->from($this->table);
        //$this->db->where('managerID',$id);
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
                //limit to userid
                $this->db->where('managerID',$this->userid);
        return $this->db->count_all_results();
    }

    public function logInsert($log){
        // var_dump($log);
        // die;
        $this->db->insert('site_attendance', $log);
    }

    public function logLoaded($log){
        $this->db->set('loaded', $log['loaded']);
        $this->db->where('userID', $log['userID']);
        $this->db->where('siteID', $log['siteID']);
        $this->db->where('start', $log['start']);
        $this->db->update('site_attendance');
    }

    public function logPunched($log){
        $this->db->select('MAX(start) as maxDate');
        $this->db->from('site_attendance');
        $this->db->where('userID', $log['userID']);
        $this->db->where('siteID', $log['siteID']);
        $maxDate = $this->db->get()->row('maxDate');

        $this->db->set('punched', date('Y-m-d G:i:s'));
        $this->db->where('userID', $log['userID']);
        $this->db->where('siteID', $log['siteID']);
        $this->db->where('start', $maxDate);
        $this->db->update('site_attendance');
    }

    public function logEnd($log){
        $this->db->select('MAX(start) as maxDate');
        $this->db->from('site_attendance');
        $this->db->where('userID', $log['userID']);
        $this->db->where('siteID', $log['siteID']);
        $maxDate = $this->db->get()->row('maxDate');

        $this->db->set('end', date('Y-m-d G:i:s'));
        $this->db->where('userID', $log['userID']);
        $this->db->where('siteID', $log['siteID']);
        $this->db->where('start', $maxDate);
        $this->db->update('site_attendance');
    }

    public function getListAbsent($managerID){
        $this->db->select("*");
        $this->db->from("manager_attendance");
        $this->db->where("userID", $managerID);
        $query = $this->db->get();

        return $query->result();
    }

private function _get_datatables_query_absent()
    {
        //print_r($_POST);
        $this->db->select('MA.managerAttendanceID, MA.attendanceDate, MA.userID, MA.attendanceStatus, AS.attStatusName, APS.attApprovalName, MA.approvalStatus');
        $this->db->from('manager_attendance MA');
        $this->db->join('att_status AS', 'AS.attStatusID = MA.attendanceStatus');
        $this->db->join('att_approval_status APS', 'APS.attApprovalID = MA.approvalStatus');
        //$this->db->where('managerID',$this->userid);
        $this->db->where('userID',$this->userid);
        $this->db->where_in('attendanceStatus', array('0'));
        //print_r($_POST['search']['value']);
        $i = 0;
        $column = array(0 => "MA.managerAttendanceID", 1 => "MA.attendanceDate",2 => "MA.userID",3 => "MA.attendanceStatus",4 => "AS.attStatusName");

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
        $this->db->from('manager_attendance');
                //limit to userid
        $this->db->where('userID',$this->userid);
        return $this->db->count_all_results();
    }  

    public function updateAbsentStatus($data)
    {
        $id = $data['id'];
        $status = $data['status'];

        $this->db->set('attendanceStatus', $status);
        $this->db->where('managerAttendanceID',  $id);
        $this->db->update('manager_attendance');        
    }

    public function updateAbsentStatusViaPunch($data)
    {
        $managerID  = $data['managerID'];
        $datepunch  = $data['datepunch'];
        $status     = $data['status'];
        // var_dump($data);

        $this->db->set('attendanceStatus', $status);
        $this->db->where('userID',  $managerID);
        $this->db->where('attendanceDate',  $datepunch);
        $this->db->update('manager_attendance');         
    }

    public function getAbsentRecord($id)
    {
        $this->db->select("*");
        $this->db->from("manager_attendance");
        $this->db->where("managerAttendanceID", $id);
        $result = $this->db->get()->row_array();

        return $result;
    }
}
