<?php
defined ('BASEPATH') OR exit('No direct access allowed!');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Image_model extends CI_Model{
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
        //model-pagination
        function count_attendance(){
//          //id
//          $this->db->where() 
//          //date
//                    ->where("activityDateTime BETWEEN $from AND $to");
          $query = $this->db->get('att_attendancedetails');
          return $query->num_rows();
         }

         function get_attendance($limit,$offset){
          $this->db->order_by("attID", "desc");
          $query = $this->db->get("att_attendancedetails",$limit,$offset);
          return $query->result_array();           // return the country 
         }
         
         function _count_attendance($from,$to,$selecttype_id,$typelist_id){ 
          $this->_selecttype($selecttype_id,$typelist_id);
          $subQuery =  $this->db->get_compiled_select();
          $this->db->where("managerID IN ($subQuery)", NULL, FALSE);
          $this->db->where('activityDate >=', $from)
                   ->where('activityDate <=', $to);
          $query = $this->db->get('att_attendancedetails');
          return $query->num_rows();
         }

         function _get_attendance($limit,$offset,$from,$to,$selecttype_id,$typelist_id){
          $this->_selecttype($selecttype_id,$typelist_id);
          $subQuery =  $this->db->get_compiled_select();
          //var_dump($subQuery);
          //die();
          $this->db->where("managerID IN ($subQuery)", NULL, FALSE);
          $this->db->where('activityDate >=', $from);
          $this->db->where('activityDate <=', $to);

          $this->db->order_by("attID", "desc");
          $query = $this->db->get("att_attendancedetails",$limit,$offset);
          return $query->result_array();           // return the country 
         }
        
         function _selecttype($select,$subselect){
             //all manager
             if($select== "1"){
                $statement = $this->db->select('userID')->from('user')->where('userLevel',2)->where('userStatus',1);
             }
             //cluster lead and operation manager
             if($select== "2"){
                $statement = $this->db->select('userID')->from('user')->where('userLevel >',2)->where('userStatus',1);
             }
             //region
             if($select== "3"){
                 //semenanjung
                 if($subselect == "1"){
                 $statement = $this->db->select('managerID')->from('att_attendancedetails')->where("(clusterID = 5 OR clusterID = 6)", NULL, FALSE);//->where('activityDate >=', $from)->where('activityDate <=', $to);
                 }
                 //sabah/sarawak
                 if($subselect == "2"){
                     $statement = $this->db->select('managerID')->from('att_attendancedetails')->where("(clusterID = 1 OR clusterID = 2 OR clusterID = 3 OR clusterID = 4 )", NULL, FALSE);
                 }
             }
             //cluster
             if($select== "4"){
                $statement = $this->db->select('managerID')->from('att_attendancedetails')->where('clusterID',$subselect);
             }
             //pi1m site
             if($select== "5"){
                $statement = $this->db->select('managerID')->from('att_attendancedetails')->where('siteID',$subselect);
             }
             if($select== "6"){
                $statement = $this->db->select('managerID')->from('att_attendancedetails')->where('managerID',$subselect);
             }
             return $statement;
         }
         //download
         function _get_attendance_download($from,$to,$selecttype_id,$typelist_id){
          $this->_selecttype($selecttype_id,$typelist_id);
          $subQuery =  $this->db->get_compiled_select();
          $this->db->where("managerID IN ($subQuery)", NULL, FALSE);
          $this->db->where('activityDate >=', $from);
          $this->db->where('activityDate <=', $to);
          
          $query = $this->db->get("att_attendancedetails");
          $array = array();
          foreach ($query->result() as $row)
            {
                $array[] = $row->imgIn;
          }
          return $array;
          //return $query->result_array();
          //return $data['imgIn'];
//          $array = array();
//            foreach($query->result() as $row){
//            
//                $array[] = $row["imgIn"];// add each user id to the array
//            }
//
//            return $array;
         }   
}