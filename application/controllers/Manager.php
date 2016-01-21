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
        
        

        $data = array(
		    'userid' => $this->userid,
		    'userLevel' => $this->userLevel,
		    'message' => 'My Message',
                    'title' => 'Manager\'s Attendance Site',
                    
		);

        //load model for manager
        $this->load->model('manager_model');
        //pass userid to model->method
        $this->manager_model->getFullName($this->userid);
        $this->manager_model->getUserLevel($this->userLevel);
        $this->manager_model->getClusterName($this->userid);
        
        //attendance
        //$this->manager_model->insertAttendance($dataAtt);
        
        

        //load complete page
        $this->load->view('header_view',$data);
        $this->load->view('nav_view');
        $this->load->view('manager_view');
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
                'managerName' => $this->input->post('managerName'),
                'siteName' => $this->input->post('siteName'),
                'activityDate' => $this->input->post('activityDate'),
                'activityTime' => $this->input->post('activityTime'),
                'activityStatus' => $this->input->post('activityStatus'),
                'outstationStatus' => $this->input->post('outstationStatus'),
                'latLongIn' => $this->input->post('latLongIn')
                 //camera disabled v0.1
                //'imgIn' => $this->input->post("fieldnameid"),
               // 'imgOut' => $this->input->post('fieldnameid'),
            );
        
        $this->manager_model->insertAttendance($data);
        echo "success";
       //echo $this->input->post('latLongIn');
       
    }
    
    //tables
    public function ajax_list()
	{
                //get the assign userid attendance list
                $this->db->where('managerID',$this->userid);
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

			//add html for action
			//$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_person('."'".$manager->attID."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  //<a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_person('."'".$manager->attID."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		
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
                 //echo "json";
	}
       
    
}
