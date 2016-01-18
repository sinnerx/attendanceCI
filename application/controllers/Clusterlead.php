<?php defined ('BASEPATH') OR exit ('No direct access allowed');

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Clusterlead extends CI_Controller {
    public function index(){
        
        //page title
        $data['title'] = "Cluster Lead Site";
        
        //load view
        $this->load->view('clusterleadHeader_view',$data);
        //$this->load->view('nav_view');
        $this->load->view('clusterlead_view');
        $this->load->view('clusterleadFooter_view');
    }
    
}