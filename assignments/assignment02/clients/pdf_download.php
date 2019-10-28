<?php
/** @noinspection HtmlDeprecatedAttribute */
ob_start();
include_once('../root.php');

// Must be logged in to view
include_once('../shared/authentication.php');
must_be_logged_in();

include_once("../shared/connection.php");

// Fetch Data
$stmt = $dbh->prepare("SELECT * FROM CLIENT");
$stmt->execute();
$allRows = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Set image path
define('K_PATH_IMAGES', '../assets/');

require "../vendor/autoload.php";

// create new PDF document
$pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Dylan Pinn & Yuqi Ma');
$pdf->SetTitle('Famox - Clients');
$pdf->SetSubject('FIT2104 A2');
$pdf->SetKeywords('FIT2104');

// set default header data
$pdf->setHeaderData('logo-sm.png', 25, 'Famox', 'Client List', array(0, 64, 128), array(0, 64, 128));
$pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


// set font
$pdf->SetFont('helvetica', '', 12);

// add a page
$pdf->AddPage();

// Add Line Break
$pdf->Ln();

// Create clients table
//column titles for display
$header = array('Client. No', 'Name', 'Address', 'Mobile', 'Email', 'Mailing List');
//Column Widths
$headerWidth = array(100, 150, 250, 150, 150, 100);

$table = '<table cellpadding="5" cellspacing="1" border="0">';
$table .= '<tr bgcolor="#336888">';
for ($i = 0; $i < sizeof($header); ++$i) {
    $table .= '<td class="heading" width="' . $headerWidth[$i] . '">' . $header[$i] . '</td>';
}
$table .= "</tr>";

$rowCount = 0;
foreach ($allRows as $row) {
    if ($rowCount % 2 == 0) {
        $table .= '<tr valign="top" bgcolor="#ACC5D3">';
    } else {
        $table .= '<tr valign="top">';
    }
    $table .= "<td>$row[id]</td>";
    $table .= "<td>$row[first_name] $row[last_name]</td>";
    $table .= "<td>$row[street] <br />$row[suburb] $row[postcode] $row[state]</td>";
    $table .= "<td>$row[mobile]</td>";
    $table .= "<td>$row[email]</td>";
    $table .= "<td>$row[mail_list]</td>";
    $table .= "</tr>";
    $rowCount++;
}
$table .= "</table>";

$pdf->writeHTML($table, false, false, false, true, 'L');

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('clients.pdf', 'I');
