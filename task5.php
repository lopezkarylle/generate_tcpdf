<?php

require "vendor/autoload.php";

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Karylle Lopez');
$pdf->SetTitle('PDC10 - TCPDF activity');
$pdf->SetSubject('TCPDF');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH,'TCPDF Favorite Quotes', 'PDC10', array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// add a page
$pdf->AddPage();

// set default font subsetting mode
$pdf->setFontSubsetting(false);

$pdf->SetFont('zapfdingbats', 'B', 20);
$pdf->Write(0, 'Quotes', '', 0, 'C', 1, 0, false, false, 0);
$pdf->Ln(10);
$pdf->SetFont('timesBI', '', 15);
$pdf->MultiCell(0, 20, "What comes easy woould not last, what lasts would not come easy.\n", 0, 'J', 0, 1, '', '', true, 0);
$pdf->Ln(2);
$pdf->SetFont('helveticaBI', '', 15);
$pdf->MultiCell(0, 20, "Do not give the best of you to those who do not see the best in you.\n", 0, 'J', 0, 1, '', '', true, 0);
$pdf->Ln(2);
$pdf->SetFont('courierBI', '', 15);
$pdf->MultiCell(0, 20, "Put your happiness over everything. This is your life, so dont worry about what they will say.\n", 0, 'J', 0, 1, '', '', true, 0);


// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_033.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+