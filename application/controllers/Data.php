
<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Data extends CI_Controller
{
  public function index()
  {
    $this->load->view('data_page_view'); 
  }
  public function toExcel()
  {
    $this->load->view('spreadsheet_view');
  }
}