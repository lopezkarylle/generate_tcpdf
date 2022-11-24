<?php
require "vendor/autoload.php";
// use TCPDF;

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Karylle Lopez');
$pdf->SetTitle('PDC10 - TCPDF activity');
$pdf->SetSubject('TCPDF');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');


// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);


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

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('times', '', 14, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage('L');

// -----------------------------------------------------------------------------

// -- set new background ---

// get the current page break margin
$bMargin = $pdf->getBreakMargin();
// get current auto-page-break mode
$auto_page_break = $pdf->getAutoPageBreak();
// disable auto-page-break
$pdf->SetAutoPageBreak(false, 0);
// set bacground image
$img_file = K_PATH_IMAGES.'hny1.jpg';
$pdf->Image($img_file, 15, 50, 35, 27, '', '', '', false, 300, '', false, false, 0);

$img_file = K_PATH_IMAGES.'hny2.jpg';
$pdf->Image($img_file, 50, 50, 34, 28, '', '', '', false, 300, '', false, false, 0);

// restore auto-page-break status
$pdf->SetAutoPageBreak($auto_page_break, $bMargin);
// set the starting point for the page content
$pdf->setPageMark();

// Table with rowspans and THEAD
$tbl = <<<EOD
<table border="1" cellpadding="3" cellspacing="2" color="#000000">
<thead>
 <tr>
  <th width="850" align="center" style="font-size:28; color:#000000;" ><b>JANUARY</b></th>
 </tr>
 <tr color="#000000">
  <td width="120" align="center"><b>SUN</b></td>
  <td width="120" align="center"><b>MON</b></td>
  <td width="120" align="center"><b>TUES</b></td>
  <td width="120" align="center"> <b>WED</b></td>
  <td width="120" align="center"><b>THURS</b></td>
  <td width="120" align="center"><b>FRI</b></td>
  <td width="120" align="center"><b>SAT</b></td>
 </tr>
</thead>
 <tr align="right" style="font-weight:400;">
 <td width="120"><b>1</b><br /><br /><br /></td>
 <td width="120"><b>2</b></td>
 <td width="120"><b>3</b></td>
 <td width="120"><b>4</b></td>
 <td width="120"><b>5</b></td>
 <td width="120"><b>6</b></td>
 <td width="120"><b>7</b></td>
 </tr>
 <tr align="right">
 <td width="120"><b>8</b><br /><br /><br /></td>
 <td width="120"><b>9</b></td>
 <td width="120"><b>10</b></td>
 <td width="120"><b>11</b></td>
 <td width="120"><b>12</b></td>
 <td width="120"><b>13</b></td>
 <td width="120"><b>14</b></td>
 </tr>
 <tr align="right">
 <td width="120"><b>15</b><br /><br /><br /></td>
 <td width="120"><b>16</b></td>
 <td width="120"><b>17</b></td>
 <td width="120"><b>18</b></td>
 <td width="120"><b>19</b></td>
 <td width="120"><b>20</b></td>
 <td width="120"><b>21</b></td>
 </tr>
 <tr align="right">
 <td width="120"><b>22</b><br /><br /><br /></td>
 <td width="120"><b>23</b></td>
 <td width="120"><b>24</b></td>
 <td width="120"><b>25</b></td>
 <td width="120"><b>26</b></td>
 <td width="120"><b>27</b></td>
 <td width="120"><b>28</b></td>
 </tr>
 <tr align="right">
 <td width="120"><b>29</b><br /><br /><br /></td>
 <td width="120"><b>30</b></td>
 <td width="120"><b>31</b></td>
 <td width="120" style="color:#000000;"><b>1</b></td>
 <td width="120" style="color:#000000;"><b>2</b></td>
 <td width="120" style="color:#000000;"><b>3</b></td>
 <td width="120" style="color:#000000;"><b>4</b></td>
 </tr>
</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('example_001.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+