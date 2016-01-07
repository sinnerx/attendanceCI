<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
         * 
	 */
    
	/*public function index()
	{
	$this->load->library('googlemaps');

$config['center'] = '37.4419, -122.1419';
$config['zoom'] = 'auto';
$config['cluster'] = TRUE;
$this->googlemaps->initialize($config);

$marker = array();
$marker['position'] = '37.429, -122.1419';
$this->googlemaps->add_marker($marker);


$marker['position'] = '32.429, -112.1419';
$this->googlemaps->add_marker($marker);


$marker['position'] = '35.429, -120.1419';
$this->googlemaps->add_marker($marker);


$marker['position'] = '54.429, -0.1419';
$this->googlemaps->add_marker($marker);
$data['map'] = $this->googlemaps->create_map();


            $this->load->view('welcome_message', $data);
                
	}*/
        function __construct() {
             parent::__construct();
                $this->load->library('javascript');
                $this->load->library('javascript/jquery');
        }
        
        public function index()
{
        
        $this->load->library('googlemaps'); 
        $config = array();
        $config['center'] = 'auto';
        $config['zoom'] = '14';
        $config['onboundschanged'] = 'if (!centreGot) {
                var mapCentre = map.getCenter();
             
                alert("Lat: "+mapCentre.lat()+", Long: "+mapCentre.lng());
                marker_0.setOptions({
                	position: new google.maps.LatLng(mapCentre.lat(), mapCentre.lng()) 
                });
                 
                $("#lat").append(mapCentre.lat());
        }
        centreGot = true;';
        $config['geocodeCaching'] = TRUE;
        $this->googlemaps->initialize($config);
        $marker = array();
       
        
        $marker['infowindow_content'] = 'this is a bubble info';
        $marker['animation']='DROP';
        //$marker['position']=$data['lat'].",".$data['lon'];
        $this->googlemaps->add_marker($marker);
        $data['map'] = $this->googlemaps->create_map();
        //$this->load->view('welcome_message', $data);
        //$data['getPosition'] = $this->googlemaps->getPosition();
       // echo(getPosition);
        $this->viewPage($data);
        }   
        public function viewPage($data) {
            
            //$latLong = new google.maps.LatLng($data);
                    $this->load->view('welcome_message', $data);
                   // print "<script type=\"text/javascript\">alert('Some text'+$latLong);</script>";
                   
                   // alert(mapCentre.lat()+","+mapCentre.lng());
                    //new google.maps.LatLng
                    
        }
}

