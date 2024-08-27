<?php
require('fpdf.php');
include ( 'engine/config.php' );

$db = new MyDB("forum");
$db->connect();

$baza = $db->query('SELECT * FROM categories');

$pdf = new FPDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);

while($row = $baza->fetch_assoc())
{
	$pdf->Cell(0,10,utf8_decode($row['title']),0,1);
	$baza2 = $db->query('SELECT * FROM subcategories WHERE category_id = ' . $row['id']);
	while($row2 = $baza2->fetch_assoc())
	{
			$pdf->Cell(0,10,' -- '.utf8_decode($row2['title']),0,1);
	}
}

$pdf->Output();

?>
