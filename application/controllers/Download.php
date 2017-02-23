<?php defined ('BASEPATH') OR exit ('No direct script access allowed!');

class Download extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->userid = $this->nativesession->get( 'userid' );
        $this->userLevel = $this->nativesession->get( 'userLevel' );
        $this->load->model('download_model','download_model');

    }

    function index() {
        $data = array(
		    'userid'    => $this->userid,
		    'userLevel' => $this->userLevel,
		    'message'   => 'My Message',
                    'title'     => 'Attendance\'s Download Site',
                    
		);
        $this->load->view('downloadHeader_view', $data);
        $this->load->view('download_view_1', $data);
        

    }
   
    function zip(){//working like charm
     set_time_limit(0);
     ini_set('memory_limit', '512M'); 
     $dir = 'images/attendance/';
     //array of images need to be dowloaded
     $files = glob($dir."*.jpg");
     //var_dump($files);
     //die();
 
    $valid_files = array();
    if(is_array($files)) {
        foreach($files as $file) {
            if(file_exists($file)) {
                $valid_files[] = $file;
            }
        }
    }
 
    if(count($valid_files > 0)){
            $zip = new ZipArchive();
            $zip_name = "zipfile.zip";
            if($zip->open($zip_name, ZIPARCHIVE::CREATE)!==TRUE){
                $error .= "* Sorry ZIP creation failed at this time";
            }
            foreach($valid_files as $file){
                $zip->addFile($file);
            }
            $zip->close();
            if(file_exists($zip_name)){
                // force to download the zip
                header("Pragma: public");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("Cache-Control: private",false);
                header('Content-type: application/zip');
                header('Content-Disposition: attachment; filename="'.$zip_name.'"');
                readfile($zip_name);
                // remove zip file from temp path
                unlink($zip_name);
            }
        } else {
            echo "No valid files to zip";
            exit;
        }


    }
    

}
?>
