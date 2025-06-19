<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';
class Pdf extends TCPDF
{
    function __construct()
    {
        parent::__construct();

    }

    public $html_footer = ''; // placeholder for custom footer

    public function setHtmlFooter($html)
    {
        $this->html_footer = $html;
    }

    public function Footer()
    {
        // Position at 15 mm from bottom
        $this->SetY(-15);

        // Set font
        $this->SetFont('dejavusans', 'I', 8);

        // Output the custom footer
        $this->writeHTMLCell(0, 10, '', '', $this->html_footer, 0, 0, false, true, 'C', true);
    }


}
/*Author:Tutsway.com */  
/* End of file Pdf.php */
/* Location: ./application/libraries/Pdf.php */