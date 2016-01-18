<?php
defined ('BASEPATH') OR exit('No direct access allowed!');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Opmanager_model extends CI_Model{
    //declare variable
    
    //construct
    public function __construct() {
        parent::__construct();
        //load db
        //$this->load->database();
    }
    
    public function getFullName($userid){
       $query = $this->db->query("SELECT userProfileFullName FROM user_profile WHERE userID ='$userid'");
        foreach ($query->result() as $row)
        {
                //return user fullname to view
               return $row->userProfileFullName;
        }
    }
    //userlevel already exist in global session
    //public function getUserLevel($userLevel){
       //userLevel
   // }
    
    public function getClusterName($userid){
        //get clustername from IRIS (siteName)
        $query = $this->db->query("SELECT siteName FROM site JOIN site_manager WHERE userID ='$userid' AND site.siteID = site_manager.siteID");
        foreach ($query->result() as $row)
        {
               //return cluster name/siteName to view
               return $row->siteName;
        }
    }
}