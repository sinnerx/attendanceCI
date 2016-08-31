<?php defined ('BASEPATH') OR exit ('No direct script access allowed!');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Manager extends CI_Controller {
    public $userid;
    public $userLevel;
    public function __construct()
	{
		parent::__construct();
                //userID/userLevel from nativesession from IRIS/main system session
                $this->userid = $this->nativesession->get( 'userid' );
                $this->userLevel = $this->nativesession->get( 'userLevel' );
                //start loading all related data
		$this->load->model('manager_model','manager');
                $this->getFullName = $this->manager->getFullName($this->userid);
                $this->getUserLevel = $this->manager->getUserLevel($this->userLevel);
                $this->getSiteName = $this->manager->getSiteName($this->userid);
                $this->getUserEmail = $this->manager->getUserEmail($this->userid);
                $this->getSiteID = $this->manager->getSiteID($this->userid);
                $this->isFirstInToday = $this->manager->isFirstInToday($this->userid);
                $this->isFourthPunched = $this->manager->isFourthPunched($this->userid);
                $this->initAnomaly = $this->manager->initAnomaly($this->userid);
                $this->getClusterLeadGroupID = $this->manager->getClusterLeadGroupID($this->userid);
                $this->getLastPunchStatus = $this->manager->getLastPunchStatus($this->userid);
                if($this->userLevel == 2){
                    $this->getClusterGroupID = $this->manager->getClusterGroupID($this->userid);
                } elseif ($this->userLevel == 3) {
                    $this->getClusterGroupID = $this->manager->getClusterLeadGroupID($this->userid);
                } elseif ($this->userLevel == 4) {
                    $this->getClusterGroupID = 0;
                }
                $this->getClusterGroup = $this->manager->getClusterGroup($this->userid);
                $this->getClusterLeadGroup = $this->manager->getClusterLeadGroup($this->userid);
	}

    public function index() {
        
        $data = array(
		    'userid' => $this->userid,
		    'userLevel' => $this->userLevel,
		    'message' => 'My Message',
                    'title' => 'Manager\'s Attendance Site',
                    'getFullName' => $this->getFullName,
                    'getUserLevel' => $this->getUserLevel,
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
                    'getClusterLeadGroup' => $this->getClusterLeadGroup
		);        
        //lite version
        $this->load->view('header_view_lite',$data);
        $this->load->view('manager_view_lite', $data);
         $this->load->view('footer_view');

    }
    public function saveAttendance(){
        $this->load->model('manager_model');
        $data = array(
                'managerID' => $this->userid,
                'clusterID' => $this->getClusterGroupID,
                'managerName' => $this->getFullName,
                'siteID' => $this->getSiteID,
                'siteName' => $this->getSiteName,
                'userEmail' => $this->getUserEmail,
                'activityDate' => date("d-m-Y"),
                'activityTime' => date("G:i"),
                'activityDateTime' => date("Y-m-d G:i:s"),
                'activityStatus' => $this->input->post('activityStatus'),
                'outstationStatus' => $this->input->post('outstationStatus'),
                'latLongIn' => $this->input->post('latLongIn'),
                'accuracy' => $this->input->post('accuracy'),
                'imgIn' => $this->input->post('imgIn'),
            );
        $this->manager_model->insertAttendance($data);
    }
    
    //tables
    public function ajax_list()
	{
                //get the assign userid attendance list
                //$this->db->where('managerID',$this->userid);
                //list the db
		$list = $this->manager->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $manager) {
			$no++;
			$row = array();
                        //$row[] = $manager->attID;
			//$row[] = $manager->managerID;
                        //$row[] = $manager->managerName;
                        //$row[] = $manager->siteName;
			$row[] = $manager->activityDate;
                        $row[] = $manager->activityTime;
			$row[] = $manager->activityStatus;
			$row[] = $manager->outstationStatus;
			$row[] = $manager->latLongIn;
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->manager->count_all(),
						"recordsFiltered" => $this->manager->count_filtered(),
						"data" => $data,
                                                
				);
                
		//output to json format
		echo json_encode($output);
	}
       
        //public function last(){
        //  $test = $this->db->insert_id();
        //  echo $test;
        //}
}
