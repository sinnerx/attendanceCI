<?php defined ('BASEPATH') OR exit ('No direct script access allowed!');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Manager extends CI_Controller {
    public $userid;
    public $userLevel;
    public $actDate;
    public $actTime;
    public $actDateTime;

    public function __construct()
	{
		parent::__construct();
                
                //userID/userLevel from nativesession from IRIS/main system session
                $this->userid = $this->nativesession->get( 'userid' );
                $this->userLevel = $this->nativesession->get( 'userLevel' );
                //start loading all related data
		$this->load->model('manager_model','manager');
                $this->getFullName = $this->manager->getFullName($this->userid);
                //$this->getUserLevel = $this->manager->getUserLevel($this->userLevel);
                $this->getSiteName = $this->manager->getSiteName($this->userid);
                $this->getUserEmail = $this->manager->getUserEmail($this->userid);
                $this->getSiteID = $this->manager->getSiteID($this->userid);
                $this->isFirstInToday = $this->manager->isFirstInToday($this->userid);
                $this->isFourthPunched = $this->manager->isFourthPunched($this->userid);
                $this->initAnomaly = $this->manager->initAnomaly($this->userid);
                $this->getClusterLeadGroupID = $this->manager->getClusterLeadGroupID($this->userid);
                $this->getLastPunchStatus = $this->manager->getLastPunchStatus($this->userid);
                               
                if($this->userLevel == 2){//manager
                    $this->getClusterGroupID = $this->manager->getClusterGroupID($this->userid);
                } elseif ($this->userLevel == 3) {//clusterlead
                    $this->getClusterGroupID = $this->manager->getClusterLeadGroupID($this->userid);
                } elseif ($this->userLevel == 4) {//operation manager
                    $this->getClusterGroupID = 0;
                }
                $this->getClusterGroup = $this->manager->getClusterGroup($this->userid);
                $this->getClusterLeadGroup = $this->manager->getClusterLeadGroup($this->userid);
                $this->getAttendanceStatus = $this->manager->getAttendanceStatus($this->userid);
	}

    public function index() {
//        var_dump($this->isFirstInToday);
//        die();
        
        $data = array(
		    'userid' => $this->userid,
		    'userLevel' => $this->userLevel,
		    'message' => 'My Message',
                    'title' => 'Manager\'s Attendance Site',
                    'getFullName' => $this->getFullName,
                    //'getUserLevel' => $this->getUserLevel,
                    'getSiteName' => $this->getSiteName,
                    'getUserEmail' => $this->getUserEmail,
                    'getSiteID' => $this->getSiteID,
                    'isFirstInToday' => $this->isFirstInToday,
                    'isFourthPunched' => $this->isFourthPunched,
                    'initAnomaly' => $this->initAnomaly,
                    'getClusterLeadGroupID' => $this->getClusterLeadGroupID,
                    'getLastPunchStatus' => $this->getLastPunchStatus,
                    'getClusterGroupID' => $this->getClusterGroupID,
                    'getClusterGroup' => $this->getClusterGroup,
                    'getClusterLeadGroup' => $this->getClusterLeadGroup,
                    'getAttendanceStatus' => $this->getAttendanceStatus
                
		);
//                print_r($data[getLastPunchStatus]);
//                die();
        //lite version
        $this->load->view('header_view_lite',$data);
        $this->load->view('manager_view_lite', $data);
         $this->load->view('footer_view');

    }
    
    public function actDateTime(){
        $this->actDate = date("d-m-Y"); 
        $this->actTime = date("H.i");
        $this->actDateTime = date("Y-m-d H:i:s");
        
    }
    
    public function saveAttendance(){
        $this->load->model('manager_model');
        //clear session from globals
        //$_SESSION = array();
        //clear session from disk
        //session_destroy();
        $this->actDateTime();
        //var_dump($this->actDate);
        //die();
        //if(($_SESSION['userid']) <> NULL){
            $data = array(
                    'managerID' => $this->userid,
                    'clusterID' => $this->getClusterGroupID,
                    'managerName' => $this->getFullName,
                    'siteID' => $this->getSiteID,
                    'siteName' => $this->getSiteName,
                    'userEmail' => $this->getUserEmail,
//                    'activityDate' => date("d-m-Y"),
//                    'activityTime' => date("G:i"),
//                    'activityDateTime' => date("Y-m-d G:i:s"),
                    'activityDate' => $this->actDate,
                    'activityTime' => $this->actTime,
                    'activityDateTime' => $this->actDateTime,
                    'activityStatus' => $this->input->post('activityStatus'),
                    'outstationStatus' => $this->input->post('outstationStatus'),
                    'latLongIn' => $this->input->post('latLongIn'),
                    'accuracy' => $this->input->post('accuracy'),
                    'imgIn' => "images/attendance/$this->actDate-$this->actTime-$this->userid.jpg",
                    'attendanceStatus' => $this->getAttendanceStatus,
                    'lateIn' => NULL,
                    'earlyOut' => NULL
                );
                $attStatus = $this->getAttendanceStatus;
                $clusterid = $this->getClusterGroupID;
                $time = $data['activityTime'];
                if($attStatus === 'in1'){//first in
                    //echo 'in1 oi oi';
                       if(($clusterid === '5' || $clusterid === '6' ) && ((strtotime($time)) > (strtotime('09:00:00')))){
                               //semenanjung late-in
                               $data['lateIn'] = 1;
                       } elseif(($clusterid === '1' || $clusterid === '2'|| $clusterid === '3' || $clusterid === '4') && ((strtotime($time)) > (strtotime('08:00:00')))){
                               //sabah/sarawak late-in
                               $data['lateIn'] = 1;
                       }

                    } elseif ($attStatus === 'in2') {//after break in
                           if(($clusterid === '5' || $clusterid === '6' ) && ((strtotime($time)) > (strtotime('14:00:00')))){
                                   //semenanjung late-in break
                                    $data['lateIn'] = 1;
                              // }
                           } elseif(($clusterid === '1' || $clusterid === '2'|| $clusterid === '3' || $clusterid === '4') && ((strtotime($time)) > (strtotime('13:00:00')))){
                                    //semenanjung late-in break
                                    $data['lateIn'] = 1;
                           }
                    }

                    //check for early out
                    if($attStatus === 'out2'){//go home
                        //semenanjung
                       if(($clusterid === '5' || $clusterid === '6' ) && ((strtotime($time)) < (strtotime('18:00:00')))){
                               //semenanjung early-out
                               $data['earlyOut'] = 1;

                       //sabah/sarawak    
                       } elseif(($clusterid === '1' || $clusterid === '2'|| $clusterid === '3' || $clusterid === '4') && ((strtotime($time)) < (strtotime('17:00:00')))){
                                //sabah/sarawak early-out
                                $data['earlyOut'] = 1;
                       }

                    } elseif ($attStatus === 'out1') {//break - out
                       if(($clusterid === '5' || $clusterid === '6' ) && ((strtotime($time)) < (strtotime('13:00:00')))){
                                // semenanjung early-out break
                                 $data['earlyOut'] = 1;
                       } elseif(($clusterid === '1' || $clusterid === '2'|| $clusterid === '3' || $clusterid === '4') && ((strtotime($time)) < (strtotime('12:00:00')))){
                                //sabah/sarawak early-out break
                                 $data['earlyOut'] = 1;
                       }
                    }
                        $this->manager_model->insertAttendance($data);
        }
    //}
    public function ajax_list()	{
		$list = $this->manager->get_datatables($this->userid);
		$data = array();
		foreach ($list as $manager) {
			//$no++;
			$row = array();
                        //$row[] = $manager->attID;
			//$row[] = $manager->managerID;
                        //$row[] = $manager->managerName;
                        //$row[] = $manager->siteName;
                        $row[] = $manager->activityStatus;
			$row[] = $manager->activityDate;
                        $row[] = $manager->activityTime;			
			$row[] = $manager->latLongIn;
                        $row[] = $manager->outstationStatus;
			$data[] = $row;
		}
		$output = array("data" => $data);
		echo json_encode($output);
	}
        
        public function saveface (){
        $this->actDateTime();
        $rawData = $_POST['imgBase64'];
        //var_dump($rawData);
        //die();
        $filteredData = explode(',', $rawData);
        $unencoded = base64_decode($filteredData[1]);
        date_default_timezone_set("Asia/Kuala_Lumpur");
        //$datime = date("d-m-Y-H.i", time() ) ; # - 3600*7
        
        //$userid  = $_POST['userid'] ;
        $punchuserid = $this->userid;
        //$punchStatus  = $_POST['punchStatus'];
        $activityDateData = $this->actDate;
        $activityTimeData = $this->actTime;
        //var_dump($activityTimeData);
        //die();
        //new date-folder
        $filename = 'images/attendance/'.$activityDateData.'-'.$activityTimeData.'-'.$punchuserid.'.jpg';
//        $dirname = dirname($filename);
//        if (!is_dir($dirname))
//        {
//            mkdir($dirname, 0755, true);
//        }
        
        // name & save the image file 
        $fp = fopen($filename, 'w');
        fwrite($fp, $unencoded);
        fclose($fp);
        //$this->db->insert('imgIn', $data);
        //$imgPath = 'images/attendance/'.$activityDateData.'-'.$activityTimeData.'-'.$userid.'-'.$punchStatus.'.jpg';
        //$this->db->insert('imgIn', $imgPath);
        //echo 'imgIn'.$imgPath;
    }
}
