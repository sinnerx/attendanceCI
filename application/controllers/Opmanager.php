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
		//$this->load->model('opmanager_model','opmanager');
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
        $this->opmanager_model->getFullName($this->userid);
        $this->opmanager_model->getUserLevel($this->userLevel);
        $this->opmanager_model->getClusterName($this->userid);
        
        //attendance
        //$this->manager_model->insertAttendance($dataAtt);
        
        

        //load complete page
        $this->load->view('header_view',$data);
        $this->load->view('nav_view');
        $this->load->view('opmanager_view');
        $this->load->view('footer_view');

    }
}