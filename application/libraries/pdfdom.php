<?php 
defined('BASEPATH') or exit('No direct script access allowed');
use Dompdf\Dompdf;

class pdfdom extends Dompdf {
  public $filename;

  public function __construct()
  {
    parent::__construct();
    $this->filename = "Struk Pembelian.pdf";
  }

  protected function ci()
  {
    return get_instance();
  }

  public function load_view($view, $data = array())
  {
    $html = $this->ci()->load->view($view, $data, TRUE);
    $this->loadHtml($html);
    $this->render();
    $this->stream($this->filename, array('attachment' => false)); 
  }
}

?>