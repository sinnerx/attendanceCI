<?php
defined ('BASEPATH') OR exit('No direct access allowed!');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Clusterlead_model extends CI_Model{
    //declare variable
    
    //construct
    public function __construct() {
        parent::__construct();
        //load db
        //$this->load->database();
    }
    
    public function getClusterName ($userid){
        //get clustername from IRIS (siteName)
        $query = $this->db->query("SELECT siteName FROM site JOIN site_manager WHERE userID ='$userid' AND site.siteID = site_manager.siteID");
        foreach ($query->result() as $row)
        {
               //return cluster name/siteName to view
               return $row->siteName;
        }
    }
    public function getClusterGroup($userid){
        //get clustername from IRIS (siteName)
        //$query = $this->db->query("SELECT clusterName FROM cluster JOIN site_manager WHERE userID ='$userid' AND site.siteID = site_manager.siteID");
        $this->db->select('clusterName');
            $this->db->from('cluster'); 
            $this->db->join('cluster_site', 'cluster_site.clusterID = cluster.clusterID');
            $this->db->join('site_manager', 'cluster_site.siteID = site_manager.siteID');
            //$this->db->where('site_manager.userID = $userid',$userid);
            $this->db->where('site_manager.userID', $userid);

/*
            SELECT clusterName
            FROM cluster
            JOIN cluster_site ON cluster_site.clusterID = cluster.clusterID
            JOIN site_manager ON cluster_site.siteID = site_manager.siteID
            WHERE site_manager.userID = '134'
                    */
                    
            $query = $this->db->get(); 
            /*if($query->num_rows() != 0)
            {
                return $query->result_array();
            }
            else
            {
                return false;
            }*/
        foreach ($query->result() as $row)
        {
               //return cluster name/siteName to view
               return $row->clusterName;
        }
    }
}