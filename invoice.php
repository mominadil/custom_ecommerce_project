<?php
$order_detail_id=$_GET['id'];

require('fpdf.php');
include 'db.php';

//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm
$row="SELECT * FROM order_details WHERE id =  '$order_detail_id'";
$row_result=mysqli_query($connect,$row);
$result=mysqli_fetch_array($row_result);

$pdf = new FPDF('P','mm','A4');

$pdf->AddPage();

//set font to arial, bold, 14pt
$pdf->SetFont('Arial','B',14);

//Cell(width , height , text , border , end line , [align] )

$pdf->Cell(130	,5,'MAKEMELIVE TECHNOLOGIES',0,0);
$pdf->Cell(59	,5,'INVOICE',0,1);//end of line

//set font to arial, regular, 12pt
$pdf->SetFont('Arial','',12);
// $pdf->Ln(40);
// $pdf->SetX(50);
$pdf->MultiCell(100	,5,'Diamond SEA CHS LTD, Plot No 134, C Wing ,Office No 9, Near Markaz Hotel, Jogeshwari West, Mumbai - 400102, Maharashtra, India',0,0);
$pdf->Cell(49	,5,'',1,1);//end of line

$pdf->Cell(40	,5,'Date',0,0);
$pdf->Cell(49	,5,'[dd/mm/yyyy]',0,1);//end of line

$pdf->Cell(130	,5,'Phone [+12345678]',0,0);
$pdf->Cell(25	,5,'Invoice #',0,0);
$pdf->Cell(34	,5,'[1234567]',0,1);//end of line

$pdf->Cell(130	,5,'Fax [+12345678]',0,0);
$pdf->Cell(25	,5,'Customer ID',0,0);
$pdf->Cell(34	,5,'[1234567]',0,1);//end of line

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189	,10,'',0,1);//end of line

//billing address
$pdf->Cell(100	,5,'Bill to',0,1);//end of line
// $name=implode(" ",$result['first_name']);
//add dummy cell at beginning of each line for indentation
$pdf->Cell(10	,5,'',0,0);
$pdf->Cell(90	,5,$result['first_name'],0,1);


$pdf->Cell(10	,5,'',0,0);
$pdf->MultiCell(90	,5,$result['address'],0,1);

$pdf->Cell(10	,5,'',0,0);
$pdf->Cell(90	,5,$result['contact'],0,1);

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189	,10,'',0,1);//end of line

//invoice contents
$pdf->SetFont('Arial','B',12);

$pdf->Cell(130	,5,'Description',1,0);
$pdf->Cell(25	,5,'Taxable',1,0);
$pdf->Cell(34	,5,'Amount',1,1);//end of line

$pdf->SetFont('Arial','',12);

//Numbers are right-aligned so we give 'R' after new line parameter

$pdf->Cell(130	,5,'UltraCool Fridge',1,0);
$pdf->Cell(25	,5,'-',1,0);
$pdf->Cell(34	,5,'3,250',1,1,'R');//end of line

$pdf->Cell(130	,5,'Supaclean Diswasher',1,0);
$pdf->Cell(25	,5,'-',1,0);
$pdf->Cell(34	,5,'1,200',1,1,'R');//end of line

$pdf->Cell(130	,5,'Something Else',1,0);
$pdf->Cell(25	,5,'-',1,0);
$pdf->Cell(34	,5,'1,000',1,1,'R');//end of line

//summary
$pdf->Cell(130	,5,'',0,0);
$pdf->Cell(25	,5,'Subtotal',0,0);
$pdf->Cell(4	,5,'$',1,0);
$pdf->Cell(30	,5,'4,450',1,1,'R');//end of line

$pdf->Cell(130	,5,'',0,0);
$pdf->Cell(25	,5,'Taxable',0,0);
$pdf->Cell(4	,5,'$',1,0);
$pdf->Cell(30	,5,'0',1,1,'R');//end of line

$pdf->Cell(130	,5,'',0,0);
$pdf->Cell(25	,5,'Tax Rate',0,0);
$pdf->Cell(4	,5,'$',1,0);
$pdf->Cell(30	,5,'10%',1,1,'R');//end of line

$pdf->Cell(130	,5,'',0,0);
$pdf->Cell(25	,5,'Total Due',0,0);
$pdf->Cell(4	,5,'$',1,0);
$pdf->Cell(30	,5,'4,450',1,1,'R');//end of line





















$pdf->Output();
?>
