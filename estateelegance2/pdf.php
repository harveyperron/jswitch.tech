<?php
require_once('/home/u853804124/public_html/TCPDF/tcpdf.php');
$pdf = new FPDF();

// Define the layout of the invoice
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Invoice', 0, 1, 'C');
$pdf->Ln(10);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, 'Company Name', 0, 1);
$pdf->Cell(0, 10, 'Company Address', 0, 1);
$pdf->Cell(0, 10, 'Company Phone Number', 0, 1);
$pdf->Cell(0, 10, 'Company Email', 0, 1);
$pdf->Ln(10);
$pdf->Cell(0, 10, 'Client Name', 0, 1);
$pdf->Cell(0, 10, 'Client Address', 0, 1);
$pdf->Cell(0, 10, 'Client Phone Number', 0, 1);
$pdf->Cell(0, 10, 'Client Email', 0, 1);
$pdf->Ln(20);

// Define the table of product information
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 10, 'Product', 1);
$pdf->Cell(40, 10, 'Quantity', 1);
$pdf->Cell(40, 10, 'Unit Price', 1);
$pdf->Cell(40, 10, 'Total', 1);
$pdf->Ln();
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 10, 'Product 1', 1);
$pdf->Cell(40, 10, '1', 1);
$pdf->Cell(40, 10, '$10.00', 1);
$pdf->Cell(40, 10, '$10.00', 1);
$pdf->Ln();
$pdf->Cell(40, 10, 'Product 2', 1);
$pdf->Cell(40, 10, '2', 1);
$pdf->Cell(40, 10, '$5.00', 1);
$pdf->Cell(40, 10, '$10.00', 1);
$pdf->Ln();

// Define the subtotal, discount, tax, and total
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(80, 10, '', 0);
$pdf->Cell(40, 10, 'Subtotal', 1, 0, 'R');
$pdf->Cell(40, 10, '$20.00', 1);
$pdf->Ln();
$pdf->Cell(80, 10, '', 0);
$pdf->Cell(40, 10, 'Discount', 1, 0, 'R');
$pdf->Cell(40, 10, '$2.00', 1);
$pdf->Ln();
$pdf->Cell(80, 10, '', 0);
$pdf->Cell(40, 10, 'Tax', 1, 0, 'R');
$pdf->Cell(40, 10, '$1.20', 1);
$pdf->Ln();
$pdf->Cell(80, 10, '', 0);
$pdf->Cell(40, 10, 'Total', 1, 0, 'R');
$pdf->Cell(40, 10, '$19.20', 1);

// Add a thank you message
$pdf->Ln(20);
$pdf->Cell(0, 10, 'Thank you for your business!', 0, 1, 'C');

// Output the PDF to the browser or save it to a file
$pdf->Output('pdfinvoice.pdf', 'I');
?>
