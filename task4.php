<?php
require "vendor/autoload.php";

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Karylle Lopez');
$pdf->SetTitle('PDC10 - TCPDF activity');
$pdf->SetSubject('TCPDF');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH,'Countries in the World with Barcode and QR code', 'PDC10', array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

$csv_file = 'countries.csv';
$handle = fopen($csv_file, 'r');
$row_index = 0; // initialize
$headers = [];
$data = [];

while (($row_data = fgetcsv($handle, 1000, ',')) !== FALSE)
{
	if ($row_index++ < 1)
	{
		foreach ($row_data as $col)
		{
			array_push($headers, $col);
		}
		continue;
	}

	$tmp = [];
	for ($index = 0; $index < count($headers); $index++)
	{
		$tmp[$headers[$index]] = $row_data[$index];
	}
	array_push($data, $tmp);
}

fclose($handle);

class MC_TCPDF extends TCPDF 
{
// Load data
function LoadData($file)
{
    // Read file lines
    $lines = file($file);
    $data = array();
    foreach($lines as $line)
        $data[] = explode(',',trim($line));
    return $data;
}

// Simple table
function BasicTable($header, $data)
{
    // Header
    foreach($header as $col)
        $this->Cell(35,12,$col,1,0);
    $this->Ln();
    // Data
    foreach($data as $row)
    {
        $country_uid = array_slice($row, 1, 1, true);

			foreach($row as $col) 
				$this->Cell(35,20,$col,1,0,'C');
				$x = $this->GetX();
				$y = $this->GetY();

			foreach($country_uid as $baqrcode)
					$brstyle = array(
						'position' => '',
						'align' => 'C',
						'stretch' => false,
						'fitwidth' => true,
						'cellfitalign' => '',
						'border' => true,
						'hpadding' => 'auto',
						'vpadding' => 'auto',
						'fgcolor' => array(0,0,0),
						'bgcolor' => false, //array(255,255,255),
						'text' => true,
						'font' => 'helvetica',
						'fontsize' => 8,
						'stretchtext' => 4);

					//set style for baqrcode
					$qrstyle = array(
						'border' => false,
						'vpadding' => 'auto',
						'hpadding' => 'auto',
						'fgcolor' => array(0,0,0),
						'bgcolor' => false, //array(255,255,255)
						'module_width' => 1, // width of a single module in points
						'module_height' => 1, // height of a single module in points
					);

					//var_dump($c);
					$this->write1DBarcode($baqrcode, 'C93', '', '', 35, 20, 0.4, $brstyle, '');
					$this->write2DBarcode($baqrcode, 'QRCODE, M', $x+43, $y, 20, 20, $qrstyle);
					$this->Ln();
		}
        //$this->Cell(array_sum($w), 0);
		
	}
    }

$pdf = new MC_TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// Column headings
$header = array('id', 'Country', 'Population', 'Bar Code', 'QR Code');
// Data loading
$data = $pdf->LoadData('countries.csv');
$pdf->SetFont('Times','',14);
$pdf->AddPage();
$pdf->BasicTable($header,$data);
$pdf->Output();
?>