<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Cashier extends CI_Controller{
  function index()
  {
    $this->load->view('cashier/index');
  }
}
?>