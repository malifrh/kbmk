<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once 'dompdf-master/autoload.inc.php';

use Dompdf\Dompdf;
use Dompdf\Options;

class PDFlib extends Dompdf
{
   protected $ci;
   private $filename;

   public function __construct()
   {
      parent::__construct();
      $this->ci = &get_instance();
   }

   public function setFileName($filename)
   {
      var_dump($filename);
      die;
      $this->filename = $filename;
   }

   public function loadView($viewFile, $data = array())
   {
      $options = new Options();
      $options->setChroot(FCPATH);
      $options->setDefaultFont('courier');

      $this->setOptions($options);

      $html = $this->ci->load->view($viewFile, $data, true);
      $this->loadHtml($html);
      $this->render();
      $this->stream($this->filename, ['Attachment' => 0]);
   }
}
