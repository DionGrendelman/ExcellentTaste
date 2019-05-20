<?php
header('Content-type: application/pdf');
/*Get core*/
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
//
/*Check if time, date and table is set in get*/
if (!isset($_GET['time']) || !$_GET['time'] || !isset($_GET['date']) || !$_GET['date'] || !isset($_GET['table']) || !$_GET['table']) {
    header('Location: /');
}
/*Nieuwe class bestelinnge*/
$reserveringen = new Reserveringen();
/*New klanten class*/
$klanten = new Klanten();
/*New bestellingen class*/
$bestellingen = new Bestellingen();
/*New MenuItem class*/
$menuitems = new MenuItems();


if (!$reservering = $reserveringen->findExt([
    'Datum' => $_GET['date'],
    'Tijd' => $_GET['time'],
    'Tafel' => $_GET['table'],
])) {
    header('Location: /');

}

require($_SERVER['DOCUMENT_ROOT'] . '/libraries/fpdf/fpdf.php');
if ($bestelling = $bestellingen->findExt([
    'Datum' => $_GET['date'],
    'Tijd' => $_GET['time'],
    'Tafel' => $_GET['table'],
])) {
    $pdf = new FPDF();
    $pdf->addPage("P", "A5");
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(30, 10, 'Aantal');
    $pdf->Cell(70, 10, 'Product');
    $pdf->Cell(50, 10, 'Prijs');
    $pdf->SetFont('Arial', '', 12);
    $price = 0;
    foreach ($bestelling as $bestel) {
        $price = $price + $bestel['Prijs'];
        $pdf->Ln();
        $pdf->Cell(30, 7, $bestel['Aantal']);
        $pdf->Cell(70, 7, $menuitems->find($bestel['Menuitemcode'])['Menuitem']);
        $pdf->Cell(50, 7, $bestel['Prijs']);
    }
    $pdf->Ln();
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(50, 7, 'Totaal');
    $pdf->Cell(50, 7, '');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(50, 7, $price);

    $pdf->Ln();
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(50, 7, 'Betaald');
    $pdf->Cell(50, 7, '');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(50, 7, '?');

    $pdf->Ln();
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(50, 7, 'Terug');
    $pdf->Cell(50, 7, '');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(50, 7, '?');
    $pdf->Output('I', 'Bon_' . $_GET['date'] . "_" . $_GET['time'] . '_' . $_GET['table'] . '.pdf');
} else {
    header('Location:/');
}