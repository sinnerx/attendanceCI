<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Snap extends CI_Controller {
    
    public function index(){
 
       
       $this->load->view('snap_header_view');
       $this->load->view('snap_view');

        
    }
    public function saveFace (){
        $rawData = $_POST['imgBase64'];
        $filteredData = explode(',', $rawData);
        $unencoded = base64_decode($filteredData[1]);
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $datime = date("d-m-Y-H.i", time() ) ; # - 3600*7
        
        $userid  = $_POST['userid'] ;
        $punchStatus  = $_POST['punchStatus'];
        // name & save the image file 
        $fp = fopen('images/'.$punchStatus.'-'.$datime.'-'.$userid.'.jpg', 'w');
        fwrite($fp, $unencoded);
        fclose($fp);
    }
    
    public function viewFace (){
        
        $filelist = opendir('images') ;
        $photos = array();

        while ($campic = readdir($filelist)) 
            {
            if (strpos($campic, '.jpg') !== false  ) 
               { $photos[] = $campic; }
            }
        closedir($filelist);
        rsort($photos);  # to display the most recent photo first, see part 3 above.

        foreach ($photos AS $photo ) 
            { echo  ' <img width=640 height=480 src="../images/'.$photo.'"> 
                      <br> '.$photo.'<br> <br> <br>' ; }
    }
}