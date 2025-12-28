<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Dompdf\Dompdf;
use Dompdf\Options;

class Pdf
{
    protected $dompdf;

    public function __construct()
    {
        require_once APPPATH . '../vendor/autoload.php';
        
        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $options->set('isHtml5ParserEnabled', true);
        
        $this->dompdf = new Dompdf($options);
    }

    public function createPDF($html, $filename = 'document.pdf', $paper = 'A4', $orientation = 'portrait')
    {
        $this->dompdf->loadHtml($html);
        $this->dompdf->setPaper($paper, $orientation);
        $this->dompdf->render();
        $this->dompdf->stream($filename, array('Attachment' => 1));
    }
}