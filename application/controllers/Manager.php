<?php defined ('BASEPATH') OR exit ('No direct script access allowed!');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Manager extends CI_Controller {
    
    public function __construct()
	{
		parent::__construct();
		$this->load->model('manager_model','manager');
	}

    public function index() {
        //$this->load->helper('url');
        //userID/userLevel from nativesession from IRIS/main system session
        $userid = $this->nativesession->get( 'userid' );
        $userLevel = $this->nativesession->get( 'userLevel' );

        $data = array(
		    'userid' => $userid,
		    'userLevel' => $userLevel,
		    'message' => 'My Message',
                    'title' => 'Manager\'s Attendance Site',
                    
		);
   /**//* $dataAtt = array(

                 //attendance
                'managerID' => $this->input->post('managerID'),
                'attID' => $this->input->post('fieldnameid'),
                'activityDate' => $this->input->post('fieldnameid'),
                'activityTime' => $this->input->post('fieldnameid'),
                'activityStatus' => $this->input->post('fieldnameid'),
                'outStationStatus' => $this->input->post('outstationStatusTxt'),
                'attendanceStatus' => $this->input->post('fieldnameid'),
                'latLongIn' => $this->input->post('valLatLong'),
                'latLongOut' => $this->input->post('curLatLong')
                 //camera disabled v0.1
                //'imgIn' => $this->input->post("fieldnameid"),
               // 'imgOut' => $this->input->post('fieldnameid'),
            );*/
        
        //echo json_encode($dataAtt);
        //load model for manager
        $this->load->model('manager_model');
        //pass userid to model->method
        $this->manager_model->getFullName($userid);
        $this->manager_model->getUserLevel($userLevel);
        $this->manager_model->getClusterName($userid);
        
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
		$list = $this->manager->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $manager) {
			$no++;
			$row = array();
                        //$row[] = $manager->attID;
			//$row[] = $manager->managerID;
                        $row[] = $manager->managerName;
                        $row[] = $manager->siteName;
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
	}
    
}
