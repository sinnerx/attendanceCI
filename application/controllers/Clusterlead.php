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
        $this->clusterlead->getUserEmail($this->userid);
        $this->clusterlead->getSiteID($this->userid);
        //$this->clusterlead->isFirstInToday($this->userid);
        //$this->clusterlead->isLastOutYesterday($this->userid);
        //$this->clusterlead->isFirstInYesterday($this->userid);
        //$this->clusterlead->hoursPerDay($this->userid);
        //load view
        $this->load->view('clusterleadHeader_view');
        //$this->load->view('nav_view');
        $this->load->view('clusterlead_view',$data);
        $this->load->view('clusterleadFooter_view');
    }
    
    public function ajax_list()
	{
                //$this->db->where('managerID',$this->userid);
        
		$list = $this->clusterlead->get_datatables();
		$data = array();
		$no = $_POST['start'];
		//print_r($no);
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
            $row[] = $clusterlead->imgIn;
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
		//print_r($output);
		echo json_encode($output);
	}

public function viewAbsent(){
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
        $this->clusterlead->getUserEmail($this->userid);
        $this->clusterlead->getSiteID($this->userid);

        $this->load->view('clusterleadHeader_view');
        //$this->load->view('nav_view');
        $this->load->view('clusterlead_view_absent',$data);
        $this->load->view('clusterleadFooter_view');
    }

    public function ajax_absent_list()
    {
        // ID
        // Date
        // Manager
        // Site
        // Status
        // Approval        
                //get the assign userid attendance list
                //$this->db->where('managerID',$this->userid);
                //list the db
        $absents = $this->clusterlead->get_datatables_absent();
        // var_dump($absents);
        // die;
        $data = array();
        $no = $_POST['start'];
        foreach ($absents as $absent) {
            $no++;
            $row = array();
                        //$row[] = $manager->attID;
            //$row[] = $manager->managerID;
                        //$row[] = $manager->managerName;
                        //$row[] = $manager->siteName;
            $row[] = $absent->managerAttendanceID;
            $row[] = $absent->attendanceDate;
            $row[] = $absent->managerName;
            $row[] = $absent->siteName;
            $row[] = $absent->attStatusName;
            $row[] = $absent->approvalStatus;
            $row[] = $absent->attendanceStatus;
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->clusterlead->count_all_absent(),
                        "recordsFiltered" => $this->clusterlead->count_filtered_absent(),
                        "data" => $data,
                                                
                );
                
        //output to json format
        echo json_encode($output);
    }   

    public function approveAbsentStatus()
    {
        // var_dump( $_POST);
        $data['id']     = $_POST['id'];
        $data['status'] = $_POST['status'];
        // die;
        $this->load->model('clusterlead_model');

        $resultList = $this->clusterlead_model->approveAbsentStatus($data);

        return "Success";
    }  

    public function ajaxColumnAbsentFilter()
    {
        //columnNumber
        // 3 = site
        // 4 = status
        // 5 = approval
        // var_dump($_POST);
        // die;
        $columnNumber = $_POST['columnNumber'];

        $this->load->model('clusterlead_model');

        switch ($columnNumber) {
            case '3':
                # code...
                // var_dump($columnNumber);
                $result = $this->clusterlead_model->getSiteInCluster();
                $sites = array();
                foreach ($result as $key => $value) {
                    # code...
                    $sites[$value['siteID']] = $value['siteName'];
                }
                echo json_encode($sites);
                
                break;            
            case '4':
                # code...
                $this->db->select("attStatusID, attStatusName");
                $this->db->from("att_status");
                $result = $this->db->get()->result_array();
                foreach ($result as $key => $value) {
                    # code...
                    $data[$value['attStatusID']] = $value['attStatusName'];
                }
                echo json_encode($data);
                break;           
            case '5':
                # code...
            // var_dump("test");
                $this->db->select("attApprovalID, attApprovalName");
                $this->db->from("att_approval_status");
                $result = $this->db->get()->result_array();
                foreach ($result as $key => $value) {
                    # code...
                    $data[$value['attApprovalID']] = $value['attApprovalName'];
                }
                echo json_encode($data);
                break;
            
            default:
                # code...
                break;
        }
    }   
    
}