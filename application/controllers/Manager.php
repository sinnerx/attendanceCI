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
                //load manager model aliases with 'manager'
		$this->load->model('manager_model','manager');
	}

    public function index() {
        //$this->load->helper('url');
        
        
        $this->load->model('manager_model', 'manager');
        $data = array(
		    'userid' => $this->userid,
		    'userLevel' => $this->userLevel,
		    'message' => 'My Message',
                    'title' => 'Manager\'s Attendance Site',
                    'getFullName' => $this->manager->getFullName($this->userid),
                    'getUserLevel' => $this->manager->getUserLevel($this->userLevel),
                    'getClusterName' => $this->manager->getClusterName($this->userid),
                    'getUserEmail' => $this->manager->getUserEmail($this->userid),
                    'getSiteID' => $this->manager->getSiteID($this->userid),
                    'isFirstInToday' => $this->manager->isFirstInToday($this->userid),
                    'isFourthPunched' => $this->manager->isFourthPunched($this->userid),
                    'initAnomaly' => $this->manager->initAnomaly($this->userid),
                    'getClusterLeadGroupID' => $this->manager->getClusterLeadGroupID($this->userid),
                    'getLastPunchStatus' => $this->manager->getLastPunchStatus($this->userid),
                    'getClusterGroupID' => $this->manager->getClusterGroupID($this->userid),
                    'getClusterGroup' => $this->manager->getClusterGroup($this->userid)
		);
                

        //load model for manager
        //$this->load->model('manager_model');
        //pass userid to model->method
        //$this->manager_model->getFullName($this->userid);
//        $this->manager_model->getUserLevel($this->userLevel);
//        $this->manager_model->getClusterName($this->userid);
//        $this->manager_model->getUserEmail($this->userid);
//        $this->manager_model->getSiteID($this->userid);
//        $this->manager_model->isFirstInToday($this->userid);
//        $this->manager_model->isFourthPunched($this->userid);
//        $this->manager_model->initAnomaly($this->userid);
        
        

        //load complete page
        //$this->load->view('header_view',$data);
        //$this->load->view('nav_view');
        
        //lite version
        $this->load->view('header_view_lite',$data);
        $this->load->view('manager_view_lite', $data);
        
        //previous
//        $this->load->view('manager_view');
         $this->load->view('footer_view');

    }
    public function saveAttendance(){
        //$jsonresult = json_decode($json)
        //echo "saveAtt";
        $this->load->model('manager_model');
        
        //print_r($dataAtt);
        $data = array(
                 //attendance
                //'latLongIn' => $this->input->post('latLongIn'),
                 
                'managerID' => $this->input->post('managerID'),
                'clusterID' => $this->input->post('clusterID'),
                'managerName' => $this->input->post('managerName'),
                'siteID' => $this->input->post('siteID'),
                'siteName' => $this->input->post('siteName'),
                'userEmail' => $this->input->post('userEmail'),
                'activityDate' => $this->input->post('activityDate'),
                'activityTime' => $this->input->post('activityTime'),
                'activityDateTime' => $this->input->post('activityDateTime'),
                'activityStatus' => $this->input->post('activityStatus'),
                'outstationStatus' => $this->input->post('outstationStatus'),
                'latLongIn' => $this->input->post('latLongIn'),
                'accuracy' => $this->input->post('accuracy'),
                'imgIn' => $this->input->post('imgIn'),
            );
        
        $this->manager_model->insertAttendance($data);
        echo "success";
       //echo $this->input->post('latLongIn');
        //$this->manager_model->setAttendanceStatus();
       
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
