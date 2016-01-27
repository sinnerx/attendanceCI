<?php defined ('BASEPATH') OR exit ('No direct access allowed');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Clusterlead extends CI_Controller {
    public $userid;
    public $userLevel;
    public function __construct()
	{
		parent::__construct();
                //userID/userLevel from nativesession from IRIS/main system session
                $this->userid = $this->nativesession->get( 'userid' );
                $this->userLevel = $this->nativesession->get( 'userLevel' );
                //load manager model aliases with 'manager'
		$this->load->model('clusterlead_model','clusterlead');
	}
    public function index(){
         $data = array(
		    'userid' => $this->userid,
		    'userLevel' => $this->userLevel,
		    'message' => 'My Message',
                    'title' => 'Cluster Lead\'s Attendance Site',
                    
		);
       
        $this->load->model('clusterlead_model');
        //pass userid to model->method
        //$this->clusterlead_model->getFullName($this->userid);
        //$this->clusterlead_model->getUserLevel($this->userLevel);
        $this->clusterlead->getClusterGroup($this->userid);
        $this->clusterlead->getClusterLeadGroupID ($this->userid);
        $this->clusterlead->getClusterLeadGroup($this->userid);
        $this->clusterlead->getClusterGroup($this->userid);
        $this->clusterlead->getClusterName($this->userid);
        $this->clusterlead->getFullName($this->userid);
        //load view
        $this->load->view('clusterleadHeader_view',$data);
        //$this->load->view('nav_view');
        $this->load->view('clusterlead_view');
        $this->load->view('clusterleadFooter_view');
    }
    
    public function ajax_list()
	{
                //$this->db->where('managerID',$this->userid);
        
		$list = $this->clusterlead->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $clusterlead) {
			$no++;
			$row = array();
                        //$row[] = $manager->attID;
			//$row[] = $manager->managerID;
                        $row[] = $clusterlead->managerName;
                        $row[] = $clusterlead->siteName;
			$row[] = $clusterlead->activityDate;
                        $row[] = $clusterlead->activityTime;
			$row[] = $clusterlead->activityStatus;
			$row[] = $clusterlead->outstationStatus;
			$row[] = $clusterlead->latLongIn;

			//add html for action
			//$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_person('."'".$admin->attID."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  //<a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_person('."'".$admin->attID."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->clusterlead->count_all(),
						"recordsFiltered" => $this->clusterlead->count_filtered(),
						"data" => $data,
                                                
				);
                
		//output to json format
		echo json_encode($output);
	}
    
}