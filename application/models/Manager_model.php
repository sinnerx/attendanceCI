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
                $this->db->select('managerID,activityDate,attendanceStatus');
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
	function get_datatables($id)	
        {
                $this->db->select('managerID,activityStatus,activityDate,activityTime,latLongIn,outstationStatus');
                $this->db->from($this->table);
		$this->db->where('managerID',$id);
		$query = $this->db->order_by('attID','desc')->limit(1)->get();
		return $query->result();
	}
}
