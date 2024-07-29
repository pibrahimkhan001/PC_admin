<?php
require('fpdf_extension.php');

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('times','B',16);
$a = 'Hello World!';
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,$a);
$pdf->SetFont('Arial','b',12);
$pdf->SetTextColor(153,0,153);
$pdf->Write(7,'Text in color, ');
$pdf->SetFont('Arial','',12);
$pdf->SetTextColor(0,0,0);
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->setMargins(20,20,30);
$pdf->MultiCell(180,15,'and text in black all in the same line and i sdnas dasklkuewr e wrwerwel er wer wler weijsdf lsdlf lerwekrj jk',0,'J');
$pdf->MultiCell(180,15,'and text in black all in the same line and i sdnas dasklkuewr e wrwerwel er wer wler weijsdf lsdlf lerwekrj jk',0,'J');
$pdf->Ln(15);


$pdf->Write(15, 'The world has a lot of km');
$pdf->subWrite(6, '2', '', 9, 5);
$pdf->SetX(100);
$pdf->Write(5, "This is text with a superscripted letter.\n");
$pdf->Ln(12);
$pdf->Ln(12);
$pdf->Ln(12);

$pdf->Write(5,'The world has a lot of H');
$pdf->subWrite(5,'2','',9,5);

$pdf->Ln(12);
$pdf->Ln(12);


$pdf->SetStyle("p","courier","N",12,"10,100,250",0);
$pdf->SetStyle("h1","times","N",18,"102,0,102",0);
$pdf->SetStyle("a","times","BU",9,"0,0,255");
$pdf->SetStyle("pers","times","I",0,"255,0,0");
$pdf->SetStyle("place","arial","U",0,"153,0,0");
$pdf->SetStyle("vb","times","B",0,"102,153,153");

// Title

$pdf->Ln(15);

// Text
$txt=" 
<p>Il <vb>était</vb> une fois <pers>une petite fille</pers> de <place>village</place>, 
la plus jolie qu'on <vb>eût su voir</vb>: <pers>sa mère</pers> en <vb>était</vb> 
folle, et <pers>sa mère grand</pers> plus folle encore. Cette <pers>bonne femme</pers> 
lui <vb>fit faire</vb> un petit chaperon rouge, qui lui <vb>seyait</vb> si bien 
que par tout on <vb>l'appelait</vb> <pers>le petit Chaperon rouge</pers>.</p> 

<p>Un jour <pers>sa mère</pers> <vb>ayant cuit</vb> et <vb>fait</vb> des galettes, 
<vb>lui dit</vb>: « <vb>Va voir</vb> comment <vb>se porte</vb> <pers>la mère-grand</pers>; 
car on <vb>m'a dit</vb> qu'elle <vb>était</vb> malade: <vb>porte-lui</vb> une 
galette et ce petit pot de beurre. »</p>
 
<p><pers>Le petit Chaperon rouge</pers> <vb>partit</vb> aussitôt pour <vb>aller</vb> 
chez <pers>sa mère-grand</pers>, qui <vb>demeurait</vb> dans <place>un autre village</place>. 
En passant dans <place>un bois</place>, elle <vb>rencontra</vb> compère <pers>le 
Loup</pers>, qui <vb>eut bien envie</vb> de <vb>la manger</vb>; mais il <vb>n'osa</vb> 
à cause de quelques <pers>bûcherons</pers> qui <vb>étaient</vb> dans 
<place>la forêt</place>.</p>
";

$pdf->WriteTag(0,10,$txt,0,"J",0,7);


$pdf->Output();
?>


