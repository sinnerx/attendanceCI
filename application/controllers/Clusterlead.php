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
		$this->load->model('clusterlead_model','manager');
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
        $this->clusterlead_model->getClusterGroup($this->userid);
        //load view
        $this->load->view('clusterleadHeader_view',$data);
        //$this->load->view('nav_view');
        $this->load->view('clusterlead_view');
        $this->load->view('clusterleadFooter_view');
    }
    
}