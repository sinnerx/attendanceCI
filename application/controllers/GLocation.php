<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class GLocation extends CI_Controller {
    
    public function index(){
     /*   $this->load->library('GMap');

        $this->gmap->GoogleMapAPI();

        // valid types are hybrid, satellite, terrain, map
        $this->gmap->setMapType('hybrid');

        // you can also use addMarkerByCoords($long,$lat)
        // both marker methods also support $html, $tooltip, $icon_file and $icon_shadow_filename
        $this->gmap->addMarkerByAddress("Some Street, Some Town, Some City, Some Country","Marker Title", "Marker Description");

        $data['headerjs'] = $this->gmap->getHeaderJS();
        $data['headermap'] = $this->gmap->getMapJS();
        $data['onload'] = $this->gmap->printOnLoad();
        $data['map'] = $this->gmap->printMap();
        $data['sidebar'] = $this->gmap->printSidebar();*/



       $this->load->view('glocation_view');
        
    }
}