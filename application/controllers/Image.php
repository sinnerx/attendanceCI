<?php defined ('BASEPATH') OR exit ('No direct script access allowed!');

class Image extends CI_Controller {
    private $userid;
    private $userLevel;
    private $typelistID;
    public function __construct()
	{
		parent::__construct();
                $this->load->helper(array('form', 'url'));
                //userID/userLevel from nativesession from IRIS/main system session
                $this->userid = $this->nativesession->get( 'userid' );
                $this->userLevel = $this->nativesession->get( 'userLevel' );
                //load manager model aliases with 'manager'
		$this->load->model('image_model','image_model');
                $this->load->library('pagination');
                $this->load->library('table');
                //$this->load->library('session');
	}

    public function index() {
        $data = array(
		    'userid' => $this->userid,
		    'userLevel' => $this->userLevel,
		    'message' => '',
                    'title' => 'View Attendance\'s Image'
                    
		);
       
        $this->load->view('imageHeader_view', $data);
        $this->load->view('image_view', $data);
        

    }
        
    public function selecttype(){
            $selecttype_id = $this->input->post('selecttype_id');
            
            //all pi1m manager
            if($selecttype_id == 1){
                //echo "<option>-- Select --</option>";
               
            }
            //All Nusuara Staff
            if($selecttype_id == 2){
                //echo "<option>-- Select --</option>";
                
            }
            //Region
            if($selecttype_id == 3){
                echo "<option>-- Select Region--</option>";
                echo "<option value=\"1\">Semenanjung Malaysia</option>";
                echo "<option value=\"2\">Sabah/Sarawak</option>";
                
            }
            //Cluster
            if($selecttype_id == 4){
                echo "<option>-- Select Cluster--</option>";
                $query = $this->db->query("select clusterID, clusterName from `cluster`"); //where userlevel > 1, userStatus =1
                foreach ($query->result() as $row)
                {
                    echo "<option value=\"$row->clusterID\">$row->clusterName</option>";
                }
            }
            //Pi1m Site
            if($selecttype_id == 5){
                echo "<option>-- Select Site--</option>";
                $query = $this->db->query("select siteID, siteName from `site` where siteID in (select siteID from `site_manager` where userID in (select userID FROM `user` WHERE (userLevel = 2 or userLevel = 3 or userLevel = 4) and userStatus = 1))"); //where userlevel > 1, userStatus =1
                foreach ($query->result() as $row)
                {
                    echo "<option value=\"$row->siteID\">$row->siteName</option>";
                }
                
            }
            //select manager/staff
           if($selecttype_id == 6){
                echo "<option>-- Select Name --</option>";
                $query = $this->db->query("SELECT userID, userProfileFullName FROM `user_profile` WHERE userID in (SELECT userID FROM `user` WHERE (userLevel = 2 OR userLevel = 3 OR userLevel = 4) AND userStatus = 1)"); //where userlevel > 1, userStatus =1
                foreach ($query->result() as $row)
                {
                    echo "<option value=\"$row->userID\">$row->userProfileFullName</option>";
                }
               
           }
           
    }
    public function listtype(){
        
    }
    
  
     public function view_search($offset=null) {
         
      $from = $this->input->post('from');
      $to = $this->input->post('to');
      $selecttype_id = $this->input->post('selecttype_id');
      $typelist_id = $this->input->post('typelist_id');
      ///var_dump($selecttype_id);
      //die();
      $this->load->library('pagination');
      $data = array(
                        'userid' => $this->userid,
                        'userLevel' => $this->userLevel,
                        'message' => '',
                        'title' => 'View Attendance\'s Image'

                    );

      $config['base_url'] = base_url().'image/view_search/';    // url of the page
      $config['total_rows'] = $this->image_model->_count_attendance($from,$to,$selecttype_id,$typelist_id); //get total number of records 
      $config['per_page'] = 30;  // define how many records on page
      $config['full_tag_open'] = '<ul class="pagination" id="search_page_pagination">';
      $config['full_tag_close'] = '</ul>';
      $config['cur_tag_open'] = '<li class="active"><a href="javascript:void(0)">';
      $config['num_tag_open'] = '<li>';
      $config['num_tag_close'] = '</li>';
      $config['cur_tag_close'] = '</a></li>';
      $config['first_link'] = 'First';
      $config['first_tag_open'] = '<li>';
      $config['first_tag_close'] = '</li>';
      $config['last_link'] = 'Last';
      $config['last_tag_open'] = '<li>';
      $config['last_tag_close'] = '</li>';
      $config['next_link'] = '<i class="fa fa-chevron-right"></i>';
      $config['next_tag_open'] = '<li>';
      $config['next_tag_close'] = '</li>';
      $config['prev_link'] = '<i class="fa fa-chevron-left"></i>';
      $config['prev_tag_open'] = '<li>';
      $config['prev_tag_close'] = '</li>';
      $config['page_query_string'] = FALSE;

      $this->pagination->initialize($config);
      
      $data['att_image'] = $this->image_model->_get_attendance($config['per_page'],$offset,$from,$to,$selecttype_id,$typelist_id);
      //var_dump($data['att_image']);
      $this->load->view('imageHeader_view', $data);
      $this->load->view('image_view', $data);
     }
     
     
    public function download(){
         $this->load->library('zip');
         $from = $this->input->post('hid_from');
         $to = $this->input->post('hid_to');
         $selecttype_id = $this->input->post('hid_selectType');
         $typelist_id = $this->input->post('hid_typelist');
         $files = $this->image_model->_get_attendance_download($from,$to,$selecttype_id,$typelist_id);
         foreach ($files as $file){
             $this->zip->read_file($file);
         }
         $this->zip->download('zipfiles.zip');
    }
}
