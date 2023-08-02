<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

define ('K_PATH_IMAGES', '/var/www/html/kulijume/');
require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';

class Pdf extends TCPDF
{
    function __construct()
    {
        parent::__construct();
    }
}

/* End of file Pdf.php */
/* Location: ./application/libraries/Pdf.php */