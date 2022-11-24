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


class MC_TCPDF extends TCPDF {

    /**
     * Print chapter
     * @param $num (int) chapter number
     * @param $title (string) chapter title
     * @param $file (string) name of the file containing the chapter body
     * @param $mode (boolean) if true the chapter body is in HTML, otherwise in simple text.
     * @public
     */
    function Header()
{
    global $title;

    // Arial bold 15
    $this->SetFont('times','B',15);
    // Calculate width of title and position
    $w = $this->GetStringWidth($title)+6;
    $this->SetX((210-$w)/2);
    // Colors of frame, background and text
    $this->SetDrawColor(0,80,180);
    $this->SetFillColor(230,230,0);
    $this->SetTextColor(220,50,50);
    // Thickness of frame (1 mm)
    $this->SetLineWidth(1);
    // Title
    $this->Cell($w,11,$title,1,1,'C',true);
    // Line break
    $this->Ln(10);
}

    public function PrintChapter($num, $title, $file, $mode=false) {
        // add a new page
        $this->AddPage();
        // disable existing columns
        $this->resetColumns();
        // print chapter title
        $this->ChapterTitle($num, $title);
        // set columns
        $this->setEqualColumns(2, 92);
        // print chapter body
        $this->ChapterBody($file, $mode);
    }

    /**
     * Set chapter title
     * @param $num (int) chapter number
     * @param $title (string) chapter title
     * @public
     */
    function ChapterTitle($num, $label)
    {
        // Arial 12
        $this->SetFont('times','',12);
        // Background color
        $this->SetFillColor(200,220,255);
        // Title
        $this->Cell(0,6,"Chapter $num : $label",0,1,'L',true);
        // Line break
        $this->Ln(4);
    }

    /**
     * Print chapter body
     * @param $file (string) name of the file containing the chapter body
     * @param $mode (boolean) if true the chapter body is in HTML, otherwise in simple text.
     * @public
     */
    public function ChapterBody($file, $mode=false) {
        $this->selectColumn();
        // get esternal file content
        $content = file_get_contents($file, false);
        // set font
        $this->SetFont('times', '', 9);
        $this->SetTextColor(50, 50, 50);
        // print content
        if ($mode) {
            // ------ HTML MODE ------
            $this->writeHTML($content, true, false, true, false, 'J');
        } else {
            // ------ TEXT MODE ------
            $this->Write(0, $content, '', 0, 'J', true, 0, false, true, 0);
        }
        $this->Ln();
    }
} // end of extended class

$pdf = new MC_TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$title = 'Prince of Lies';
$pdf->SetTitle($title);
$pdf->SetAuthor('James Lowder');
$pdf->PrintChapter('Authors Note','Authors Note','1_authors_note.txt');
$pdf->PrintChapter('Prologue','Prologue', '2_prologue.txt');
$pdf->PrintChapter(1,'LIFE UNDERGROUND','3_chap1.txt');
$pdf->PrintChapter(2,'BOOK OF LIES','4_chap2.txt');
$pdf->PrintChapter(3,'POINT OF VIEW','5_chap3.txt');
$pdf->PrintChapter(4,'SOUL SEARCHING','6_chap4.txt');
$pdf->PrintChapter(5,'AGENT OF HOPE','7_chap5.txt');
$pdf->Output();
?>