<?php
defined ('BASEPATH') OR exit ('No direct access allowed!');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Manager_model extends CI_Model {
    //declare for att tables
    //public $userid;
    var $table = 'att_attendancedetails';
    var $column = array('attID','clusterID','managerID','managerName', 'siteID','siteName','activityDate','activityTime', 'activityDateTime','activityStatus','outstationStatus', 'latLongIn', 'accuracy','imgIn'); //set column field database for order and search
    var $order = array('attID' => 'desc'); // default order 
    var $isFirstIn;
    var $isLastOut;
    var $isLate;
    var $isEarly;
        
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
    
    public function getUserLevel($userLevel){
       //userLevel
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
         //$this->db->set($data);
         $this->db->insert('att_attendancedetails',$data);
         //echo $data['attID'];
         $this->setAttendanceStatus();

    }
    
    public function setAttendanceStatus(){
            
            $this->db->from('att_attendancedetails');
            $this->db->where('managerID', $this->userid);
            $this->db->where('activityDate', date('d-m-Y'));
            $query = $this->db->get();
            foreach ($query->result() as $row)
                {
                    $row->attID;
                   // $row->activityTime;
               }
            //$row1 = $query->row();
            $num = $query->num_rows();
            if ($num === 1){
                $this->db->set('attendanceStatus', 'in1');
                $this->db->where('attID',  $row->attID);
                $this->db->update('att_attendancedetails');
                //$this->isLateIn();
                //
                //
                } elseif( $num === 2){
                    $this->db->set('attendanceStatus', 'out1');
                    $this->db->where('attID',  $row->attID);
                    $this->db->update('att_attendancedetails');
                    //
                    }  elseif( $num === 3){
                        $this->db->set('attendanceStatus', 'in2');
                        $this->db->where('attID',  $row->attID);
                        $this->db->update('att_attendancedetails');
                        //
                        }  elseif( $num === 4){
                            $this->db->set('attendanceStatus', 'out2');
                            $this->db->where('attID',  $row->attID);
                            $this->db->update('att_attendancedetails');
                            //
                } else{
                    // disable punch 
                }
                //check late in/out
                $this->isLateInOut();
            }
            
            public function isLateInOut (){
                $this->db->from('att_attendancedetails');
                $this->db->where('managerID', $this->userid);
                $this->db->where('activityDate', date('d-m-Y'));
                //$this->db->where('attendanceStatus', 'in1');
                $query = $this->db->get();
                $num = $query->num_rows();
                $row = $query->row($num-1);
                //echo 'num_rows: '.$num.' |';
                $time = $row->activityTime;
                $clusterid = $row->clusterID;
                $attStatus = $row->attendanceStatus;
//                echo 'time:'.$time.' |';
//                echo 'attID:'.$row->attID.' |';
//                echo 'attendanceStatus:'.$attStatus.' |';;
//                echo 'clusterID:'.$clusterid.' |';
                
                //check for late in
                if($attStatus === 'in1'){//first in
                    
                   if($clusterid === '5' || $clusterid === '6' ){
                       
                       if((strtotime($time)) > (strtotime('09:00:00'))){// late in for semenanjung
                           //echo "semenanjung late!";
                           $this->db->set('lateIn', 1);
                           $this->db->where('attID',  $row->attID);
                           $this->db->update('att_attendancedetails');
                       }
                   } elseif($clusterid === '1' || $clusterid === '2'|| $clusterid === '3' || $clusterid === '4'){
                       
                       if((strtotime($time)) > (strtotime('08:00:00'))){//late in for sabah/sarawak
                           //echo "sabah/sarawak late!";
                           $this->db->set('lateIn', 1);
                           $this->db->where('attID',  $row->attID);
                           $this->db->update('att_attendancedetails');
                       }
                   }
                   
                } elseif ($attStatus === 'in2') {//after break in
                       if($clusterid === '5' || $clusterid === '6' ){
                           //semenanjung - break
                           if((strtotime($time)) > (strtotime('14:00:00'))){ //late in after break
                               //echo "semenanjung late break in!";
                                $this->db->set('lateIn', 1);
                                $this->db->where('attID',  $row->attID);
                                $this->db->update('att_attendancedetails');
                           }
                       } elseif($clusterid === '1' || $clusterid === '2'|| $clusterid === '3' || $clusterid === '4'){
                           //sabah/sarawak - break 
                           if((strtotime($time)) > (strtotime('13:00:00'))){ //late in after break
                               //echo "semenanjung late break in!";
                                $this->db->set('lateIn', 1);
                                $this->db->where('attID',  $row->attID);
                                $this->db->update('att_attendancedetails');
                           }
                       }
                }

                //check for early out
                if($attStatus === 'out2'){//go home
                    //semenanjung
                   if($clusterid === '5' || $clusterid === '6' ){
                       //before 6 flag early
                       if((strtotime($time)) < (strtotime('18:00:00'))){// early out for semenanjung
                           $this->db->set('earlyOut', 1);
                           $this->db->where('attID',  $row->attID);
                           $this->db->update('att_attendancedetails');
                       }
                   //sabah/sarawak    
                   } elseif($clusterid === '1' || $clusterid === '2'|| $clusterid === '3' || $clusterid === '4'){
                       //before 5 flag early
                       if((strtotime($time)) < (strtotime('17:00:00'))){//early out for sabah/sarawak
                           $this->db->set('earlyOut', 1);
                           $this->db->where('attID',  $row->attID);
                           $this->db->update('att_attendancedetails');
                       }
                   }
                   
                } elseif ($attStatus === 'out1') {//break - out
                   //semenanjung
                   if($clusterid === '5' || $clusterid === '6' ){
                       //before 1 flag early
                       if((strtotime($time)) < (strtotime('13:00:00'))){ //late in after break
                            $this->db->set('earlyOut', 1);
                            $this->db->where('attID',  $row->attID);
                            $this->db->update('att_attendancedetails');
                       }
                   //sabah/sarawak
                   } elseif($clusterid === '1' || $clusterid === '2'|| $clusterid === '3' || $clusterid === '4'){
                       //before 12 flag early
                       if((strtotime($time)) < (strtotime('12:00:00'))){ //late in after break
                            $this->db->set('earlyOut', 1);
                            $this->db->where('attID',  $row->attID);
                            $this->db->update('att_attendancedetails');
                       }
                   }
                }
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

	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->table);
	}
        
        
        //isfirst in / latein catch here
        public function isFirstInToday(){
        //$this->db->select('activityDate');
        $this->db->from('att_attendancedetails');
        
        $this->db->where('managerID', $this->userid);
        $this->db->where('activityStatus !=', 'IN');
        //isnnotdate
        //$this->db->where('activityDate !=', date('d-m-Y'));
        //isdate
        $this->db->where('activityDate', date('d-m-Y'));
        $query = $this->db->get();
        foreach ($query->result() as $row)
            {
                $row->activityDate;
               // $row->activityTime;
            }
        $num = $query->num_rows();
        //var_dump(empty($query));
            //if in dont exist - its the first in
            if ($num === 0){
                $isFirstIn = 1;
                
               //echo 'fisrtIn: '.$isFirstIn;
                }else{//is not the first in - possible anomaly
                    $isFirstIn = 0;
                   //echo 'fisrtIn: '.$isFirstIn;
            } 
        //echo ' | '.date('H:i'); 
             //**print_r($row);
        }
        
        
        public function isFirstIn(){
        $this->db->from('att_attendancedetails');
        $this->db->where('managerID', $this->userid);
        $this->db->where('activityStatus', 'IN');
        //$lastOut = $this->isLastOut();
        //$this->db->where('activityDate', $lastOut->activityDate );
        $query = $this->db->get();
        foreach ($query->result() as $row)
            {
                $row->activityDate;
            }
        $num = $query->num_rows();
        //$num2 = $query->row();
        $row = $query->last_row();
        //$row = $query->row_array();
        //print_r($row);
        echo 'isInLastDate: '.$row->activityDate;
        echo 'isInLastDateID: '.$row->attID;
        //** update in1
        return $row;
            
        }
        
        //last out yesterday
        public function isLastOut(){
        $this->db->from('att_attendancedetails');
        $this->db->where('managerID', $this->userid);
        $this->db->where('activityStatus', 'OUT');
        $query = $this->db->get();
        foreach ($query->result() as $row)
            {
                $row->activityDate;
            }
        $num = $query->num_rows();
        //$num2 = $query->row();
        $row = $query->last_row();
        //$lastRow = $row;

            //echo 'isLastOut[$num]'.$num; 
            //if out no even and not more than 1
            //if ($num % 2 === 0){
            if ($num > 1){
                $isLastOut = 1;
                $isAnomaly = 0;
                //echo '$isLastOut'.$isLastOut;
                //echo '$isAnomaly'.$isAnomaly;
                }else if($num ){
                    $isLastOut = 0;
                    $isAnomaly = 1;
                    //echo '$isLastOut'.$isLastOut;
                    //echo '$isAnomaly'.$isAnomaly;
            }
            //last row
            //print_r($row);
            //echo 'rowDate: '.$row->attID;
            return $row;
        }
        
        
        
        public function hoursPerDay(){
        
        //total punch array/yesterday
        $this->db->select('activityTime');    
        $this->db->from('att_attendancedetails');
        $this->db->where('managerID', $this->userid);
        $yesterdayDate = date('d-m-Y', strtotime('-1 days'));
        $this->db->where('activityDate', $yesterdayDate);
        
        //test on 29 jan 2016
        //$this->db->where('activityDate', '29-01-2016');
        $query = $this->db->get();
        foreach ($query->result() as $row)
            {
                $row->activityTime;
            }
        $num = $query->num_rows();

        $totalPunch = $num;
        echo 'totalPunch: '.$num.' | ';
            
        //out
        $this->db->select('activityTime');    
        $this->db->from('att_attendancedetails');
        $this->db->where('managerID', $this->userid);
        $this->db->where('activityStatus', 'OUT');
        //isnnotdate
        //$this->db->where('activityDate !=', date('d-m-Y'));
        //isdate yesterday
        $yesterdayDate = date('d-m-Y', strtotime('-1 days'));
        $this->db->where('activityDate', $yesterdayDate);
        
        //test on 29 jan 2016
        //$this->db->where('activityDate', '29-01-2016');
        $query = $this->db->get();
        foreach ($query->result() as $row)
            {
                $row->activityTime;
            }
        //total punch-out
        $numOut = $query->num_rows();
        //$row = $query->last_row();
        $rowOut = $query->row_array();
        //echo ' | '.date('H:i'); 
        //print_r($row);
        //$timeOut = [];
        $totalPunchOut = $num;
            //echo 'totalPunchOut: '.$totalPunchOut;
            //$numOut/In - no of punch out/in
            for ($i = 0; $i < $numOut; $i++){
               $rowOut = $query->row_array($i);
               //**echo 'rowOut'.$i.': '.$rowOut['activityTime'].' | ';
               $timeOut[$i] = $rowOut['activityTime'];

            }
        
        //in
        $this->db->select('activityTime');    
        $this->db->from('att_attendancedetails');
        $this->db->where('managerID', $this->userid);
        $this->db->where('activityStatus', 'IN');
        //isnnotdate
        //$this->db->where('activityDate !=', date('d-m-Y'));
        //isdate
        $yesterdayDate = date('d-m-Y', strtotime('-1 days'));
        $this->db->where('activityDate', $yesterdayDate);
        
        //test on 29 jan 2016
        //$this->db->where('activityDate', '29-01-2016');
        $query = $this->db->get();
        foreach ($query->result() as $row)
            {
                $row->activityTime;
            }
         //total punch in   
        $numIn = $query->num_rows();
        //$row = $query->last_row();
        $rowIn = $query->row_array();
        //echo ' | '.date('H:i'); 
        //$roww = $query->row(2);
        //echo $rowIn[2];
        //print_r($rowIn);
        $totalPunchIn = $num;
            //echo 'totalPunchIn: '.$totalPunchIn;
            //$numOut/In - no of punch out/in
            for ($i = 0; $i < $numIn; $i++){
               $rowIn = $query->row_array($i);
               echo 'rowIn'.$i.': '.$rowIn['activityTime'].' | ';
               $timeIn[$i] = $rowIn['activityTime'];
               
            }
            //calculate totalhour
            $totalhour = 0;
            //$totalhour1 = 0;
            $firstIn = $this->isFirstIn();
            $firstIn = $this->isFirstIn()->activityTime;
            //if((strtotime($firstIn)- 9) >= 0){
                for($i=0; $i < $numOut; $i++){

                    $totalhour += ((strtotime($timeOut[$i]) - strtotime($timeIn[$i]))/3600);
                }
            //}
            //echo 'fisrtIn: '.strtotime('09:00');
            //in after 9
            echo 'Balance: '.(strtotime('09:00') - (strtotime($firstIn)));
            $totalhour1 = ((strtotime($timeOut[0]) - strtotime($firstIn))/3600);  
            echo 'totalhour1: '.$totalhour1;
            echo 'totalhours: '.round($totalhour, 2);
            
            //insert to db
            $this->db->set('hours', round($totalhour, 2));
            $lastRow = $this->isLastOut();
            $this->db->where('attID', $lastRow->attID);
            //**echo 'lasthours: '.$lastRow->hours;
            if($lastRow->hours == 0){
                $this->db->update('att_attendancedetails');
            }
            //$this->db->insert();
            //$firstIn = array();
            
           //print_r($firstIn);
            //echo $firstIn;
            
        }//end of hoursPerDay
        
        
        public function  isLastActivity(){
            
        }
        
        public function initAnomaly(){
            $this->db->from('att_attendancedetails');
            $this->db->where('managerID', $this->userid);
            //$this->db->where('activityDate', date('d-m-Y'));
            //$this->db->where('attendanceStatus', 'in1');
            $query = $this->db->get();
            if($query->num_rows() <> 0){
                //echo 'init';
                $this->isAnomaly();
            }
        }
        
        public function isLastDay(){
                $this->db->from('att_attendancedetails');
                $this->db->where('managerID', $this->userid);
                //$this->db->where('activityDate', date('d-m-Y'));
                //$this->db->where('attendanceStatus', 'in1');
                $query = $this->db->get();
                $last = $query->last_row();
                
                $lastdate = $last->activityDate;
                //echo 'last_date_:'.$lastdate;
                return $lastdate;
        }
        public function isAnomaly(){
                //echo 'asdasdasd'.$this->isLastDay();
            
                $lastday = $this->isLastDay();
                $this->db->from('att_attendancedetails');
                $this->db->where('managerID', $this->userid);
                $this->db->where('activityDate', $lastday);
                //$this->db->where('attendanceStatus', 'in1');
                $query = $this->db->get();
                $last = $query->last_row();
                $num = $query->num_rows();
                $row = $query->row($num-1);
                $date = $last->activityDate;
                $lastAtt = $last->attendanceStatus;
//                echo 'last_row:'.$last->attID;
//                echo 'last_date:'.$date;
//                echo 'num_row:'.$num;
//                echo 'last_att:'.$lastAtt;
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
                            //'anomaly' => 1
                            
                        );
                        
                         $this->db->where('activityDate', $date);
                         $this->db->insert('att_attendancedetails', $data);
                         //set whole row flag for anomaly
                         $this->db->set('anomaly', 1);
                         $this->db->where('activityDate',  $date);
                         $this->db->update('att_attendancedetails');
                        
                        
                        //update addnote - system force punch activated.
                        
                        
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
                         $this->db->update('att_attendancedetails');
                    }
                }
        }
        
        public function isFourthPunched(){
            $this->db->from('att_attendancedetails');
            $this->db->where('managerID', $this->userid);
            $this->db->where('activityDate', date('d-m-Y'));
            //$this->db->where('attendanceStatus', 'in1');
            $query = $this->db->get();
            //$last = $query->last_row();
            $num = $query->num_rows();
            if($num === 4){
                return "true";
            } else {
                return "false";
            }
        }
        public function updateNewRecords(){
        //for userEmail & clusterID        
        }
}