<?php defined ('BASEPATH') OR exit ('No direct script access allowed!');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Reporting extends CI_Controller {

	public $userid;
    public $userLevel;

    private $data_post;
    public function __construct()
	{
		parent::__construct();
                //userID/userLevel from nativesession from IRIS/main system session
                $this->userid = $this->nativesession->get( 'userid' );
                $this->userLevel = $this->nativesession->get( 'userLevel' );
                //load manager model aliases with 'manager'
		$this->load->model('clusterlead_model','clusterlead','reporting_model');
	}

	public function index(){
        $data = array(
		    'userid' => $this->userid,
		    'userLevel' => $this->userLevel,
		    'message' => 'My Message',
                    'title' => 'Manager\'s Attendance Site',
                    
		);		

        $this->load->model('reporting_model');
        $data['cluster_list'] = $this->reporting_model->get_cluster();
        //print_r($data['cluster_list']);


        $this->load->model('clusterlead_model');
		//load view
        $this->load->view('clusterleadHeader_view',$data);
        //$this->load->view('nav_view');
        $this->load->view('clusterlead_report_view');
        $this->load->view('clusterleadFooter_view');
	}

    public function get_site(){
        $this->load->model('reporting_model');
        if (isset($_GET['term'])){
          $q = strtolower($_GET['term']);
          $this->reporting_model->get_list_site($q);
        }
    }

    public function get_user(){
        $this->load->model('reporting_model');
        //print_r($this->user_model->get_list_user('a'));
        if (isset($_GET['term'])){
          $q = strtolower($_GET['term']);
          $this->reporting_model->get_list_user($q);
        }
    }  

    public function get_region($id = null){
        $this->load->model('reporting_region');


    }  

    public function get_cluster($id = null){
        //print_r($_GET['region_selected']);
        $id = $_GET['region_selected'];
        $this->load->model('reporting_model');
        $data = $this->reporting_model->get_cluster($id);
        echo json_encode($data);
        //return $data['cluster_list'];
        //print_r($data['cluster_list']);

    }

    public function show_result(){
        $data = array(
            'userid' => $this->userid,
            'userLevel' => $this->userLevel,
            'message' => 'My Message',
                    'title' => 'Manager\'s Attendance Site',
                    
        );





        //$data['post'] = $_POST;
        $this->load->model('clusterlead_model');
        $this->load->view('clusterleadHeader_view',$data);
        //$this->load->view('nav_view');
        //print_r($data['post']);

        // {
        // dateFrom: "30-01-2016",
        // dateTo: "06-01-2016",
        // forpi1m: "1",
        // region: "1",
        // cluster: "1",
        // sitename: "",
        // siteid: "",
        // username: "",
        // userid: "",
        // mysubmit: "Submit Post!"
        // },
        //$this->data_post = $data['post'];
        //print_r($this->data_post);
        //$this->ajax_list();
        $this->load->view('clusterLead_report_result_view');
        //$this->ajax_list();
        $this->load->view('clusterleadFooter_view');

    }


    public function ajax_list()
    {
                //$this->db->where('managerID',$this->userid);
        
        //print_r($_POST);
        //$data = $_POST;
        //print_r($_GET['cluster']);
        //$cluster_id = $_GET['cluster'];
        //parse_str($_GET, $output);
        //print_r($output);
        //$this->uri->segment(2, 0);
        //print_r($cluster_id);

        $this->load->model('reporting_model');
        $list = $this->reporting_model->get_datatables($_GET);
        //print_r($list);
        $data = array();
        $no = isset($_GET['start']);
        foreach ($list as $item) {
            $no++;
            $row = array();
                        //$row[] = $manager->attID;
            //$row[] = $manager->managerID;
            $row[] = $item->managerName;
            $row[] = $item->siteName;
            $row[] = $item->activityDate;
            $row[] = $item->activityTime;
            $row[] = $item->activityStatus;
            $row[] = $item->outstationStatus;
            $row[] = $item->latLongIn;

            //add html for action
            //$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_person('."'".$admin->attID."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  //<a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_person('."'".$admin->attID."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
        
            $data[] = $row;
        }

        $output = array(
                        //"draw" => isset($_POST['draw']),
                        "recordsTotal" => $this->reporting_model->count_all(),
                        "recordsFiltered" => $this->reporting_model->count_filtered(),
                        "data" => $data,
                                                
                );
                
        //output to json format
        echo json_encode($output);
    }

    public function test_model_function (){
        $this->load->model('reporting_model');
        
        $list = $this->reporting_model->display_result();

        print_r($list);
    }
        
}