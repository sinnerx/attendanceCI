<?php defined ('BASEPATH') OR exit ('No direct script access allowed!');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Opmanager extends CI_Controller {
    
    public function __construct()
	{
		parent::__construct();
                //userID/userLevel from nativesession from IRIS/main system session
                $this->userid = $this->nativesession->get( 'userid' );
                $this->userLevel = $this->nativesession->get( 'userLevel' );
                //load opmanager model aliases with 'manager'
		$this->load->model('opmanager_model','opmanager');
	}
         public function index() {
        //$this->load->helper('url');
        $data = array(
		    'userid' => $this->userid,
		    'userLevel' => $this->userLevel,
		    'message' => 'My Message',
                    'title' => 'Operation Manager\'s',
                    
		);
  
        //load model for manager
        $this->load->model('opmanager_model');
        //pass userid to model->method
        $this->opmanager->getClusterGroup($this->userid);
        $this->opmanager->getClusterLeadGroupID ($this->userid);
        $this->opmanager->getClusterLeadGroup($this->userid);
        $this->opmanager->getClusterGroup($this->userid);
        $this->opmanager->getClusterName($this->userid);
        $this->opmanager->getFullName($this->userid);
        $this->opmanager->getUserEmail($this->userid);
        $this->opmanager->getSiteID($this->userid);
        
        //attendance
        //$this->manager_model->insertAttendance($dataAtt);
        
        

        //load complete page
        $this->load->view('opmanagerHeader_view',$data);

        $this->load->view('opmanager_view');
        $this->load->view('opmanagerFooter_view');

    }
    
    
    
    //tables
    public function ajax_list()
	{
                //$this->db->where('managerID',$this->userid);
        
		$list = $this->opmanager->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $opmanager) {
			$no++;
			$row = array();
                        //$row[] = $manager->attID;
			//$row[] = $manager->managerID;
                        $row[] = $opmanager->managerName;
                        $row[] = $opmanager->siteName;
			$row[] = $opmanager->activityDate;
                        $row[] = $opmanager->activityTime;
			$row[] = $opmanager->activityStatus;
			$row[] = $opmanager->outstationStatus;
			$row[] = $opmanager->latLongIn;
                        $row[] = $opmanager->imgIn;
			//add html for action
			//$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_person('."'".$admin->attID."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  //<a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_person('."'".$admin->attID."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->opmanager->count_all(),
						"recordsFiltered" => $this->opmanager->count_filtered(),
						"data" => $data,
                                                
				);
                
		//output to json format
		echo json_encode($output);
	}
    
}

