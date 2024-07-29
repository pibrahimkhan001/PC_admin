<?php
@session_start();
if(!empty($_SESSION['cert_user']) && !empty($_SESSION['priv']) && $_SESSION['priv']=="admin"){
require('fpdf181/fpdf_extension.php');
if(!empty($_POST['htno']) && !empty($_POST['stname']) &&  !empty($_POST['fname'])  && !empty($_POST['mname']) && !empty($_POST['course'])  && !empty($_POST['gender']) && !empty($_POST['month']) && !empty($_POST['year']) && !empty($_POST['pcissued']) && !empty($_POST['class'])  ){

$res=$_POST;
require('pcgs.php');
$a=new PCGS();
$t=$a->dumpDetails($_POST['htno']);
$b=$a->deleteHtno($_POST['htno']);
$cr=substr($_POST['htno'],5,1);
$sp=substr($_POST['htno'],6,2);
$x=$a->add_details($res['htno'],$res['stname'],$res['fname'],$res['mname'],$res['gender'],$cr,$sp,$res['month'],$res['year'],$res['percentage'],$res['class'],$res['adhar'],$res['existingimg'],$res['pcissued'],$_SESSION['cert_user']);


if($x['status']==1 && $t==1 && $b==1){


$pdf=new PDF();


$pdf->Addpage();
$ffamily1="times";
$ffamily2="Arial";
$fstyle1 = "I";
$fstyle2 = "B";
$fsize1 = 16;
$fsize2 = 16;

$lnh = 12;

if($res['gender']=="M" || $res['gender']=="MALE"){
 $v1= "Mr.";
 $v2 = "son";
 $v3 = "he" ;
 $v4 = "He";
} else{
  $v1 = "Ms.";
  $v2 = "daughter";
  $v3 = "she";
  $v4 = "She";
}

$space = chr(160).chr(160);
for($i=0;$i<4;$i++){
	$fn = explode(" ",$res['fname'],2);

	if(count($fn)==2 && strlen($fn[0])<8){
		$res['fname'] = $fn[0].$space.$fn[1];
	}
	else{
		break;
	}
}

for($i=0;$i<4;$i++){
	$mn = explode(" ",$res['mname'],2);

	if(count($mn)==2 && strlen($mn[0])<=4){
		$res['mname'] = $mn[0].$space.$mn[1];
	}
	else{
		break;
	}
}


$space = chr(160);




$pdf->SetY(35.4028);
$pdf->SetLeftMargin(47.5);
$pdf->setFont($ffamily2,$fstyle2,$fsize2);
$pdf->write($lnh,$res['htno']);
$pdf->SetMargins(19,10,19);
$pdf->SetY(104);


$pdf->AddFont('coneria','','ConeriaFat.php');
$pdf->AddFont('ARLRDBD','','ARMEB.php');

$pdf->SetStyle("font1","coneria","",15,"0,0,0");
$pdf->SetStyle("font2","arial","B",15,"0,0,0");


$dt = $res['month'].$space.$res['year'];
if($cr=="A"){
  $data = "<font1>This is to certify that </font1><font2>".$res['stname'].", </font2><font1>".$v2." of </font1><font2>".$res['fname']." & ".$res['mname']."</font2><font1> has passed the </font1><font2>Bachelor of Technology (".$res['spec'].")</font2><font1> examination of this College held in the month of ".$dt."</font1><font1> and that ".$v3." has placed in </font1><font2>".$res['class'].".</font2><font1> ".$v4." has satisfied all the requirements necessary for the award of </font1><font2>".$res['course'].". Degree</font2><font1> of the Jawaharlal Nehru Technological University Anantapur, Ananthapuramu.</font1> ";

}
elseif($cr=="D"){
  if(!empty($res['dept'])){
    $data = "<font1>This is to certify that </font1><font2>".$res['stname'].", </font2><font1>".$v2." of  </font1><font2>".$res['fname']." & ".$res['mname']."</font2><font1> has passed the </font1><font2>Master of Technology </font2><font1>in the faculty of </font1><font2>".$res['dept']."</font2><font1> with specialization in </font1><font2>".$res['spec']."</font2><font1> held in the month of ".$dt."</font1><font1> and that ".$v3." was placed in </font1><font2>".$res['class'].".</font2><font1> ".$v4." has satisfied all the requirements necessary for the award of </font1><font2>".$res['course'].". Degree</font2><font1> of the Jawaharlal Nehru Technological University Anantapur, Ananthapuramu.</font1> ";

      }
  else{

    $data = "<font1>This is to certify that </font1><font2>".$res['stname'].", </font2><font1>".$v2." of </font1><font2>".$res['fname']." & ".$res['mname']."</font2><font1> has passed the </font1><font2> Master of Technology </font2><font1>with specialization in </font1><font2>".$res['spec']."</font2><font1> held in the month of ".$dt."</font1><font1> and that ".$v3." was placed in </font1><font2>".$res['class'].".</font2><font1> ".$v4." has satisfied all the requirements necessary for the award of </font1><font2>".$res['course'].". Degree</font2><font1> of the Jawaharlal Nehru Technological University Anantapur, Ananthapuramu.</font1> ";
  }
}
elseif($cr=="F"){
  $data = "<font1>This is to certify that </font1><font2>".$res['stname'].", </font2><font1>".$v2." of </font1><font2>".$res['fname']." & ".$res['mname']."</font2><font1> has passed the </font1><font2>Master of Computer Applications</font2><font1> examination of this College held in the month of ".$dt."</font1><font1> and that ".$v3." has placed in </font1><font2>".$res['class'].".</font2><font1> ".$v4." has satisfied all the requirements necessary for the award of </font1><font2>".$res['course']." Degree</font2><font1> of the Jawaharlal Nehru Technological University Anantapur, Ananthapuramu.</font1> ";
}
else{
  /*urike  */


}

$pdf->WriteTag(0,$lnh,$data,0,"J",0,0);
$pdf->Ln(8);
$data = "The medium of instruction is ";
$pdf->Write($lnh,$data);

$pdf->setFont($ffamily2,$fstyle2,$fsize2);
$data = "ENGLISH.";
$pdf->Write($lnh,$data);

$pdf->Ln(20);
$pdf->setY(230);



$data = date("d");
$pdf->Write($lnh,$data);
$data = date("S");
$pdf->subWrite($lnh,$data,'',9,5);
$data = " ".date("F Y");
$pdf->Write($lnh,$data);
$spdf=$_POST['htno'].".pdf";
$pdf->output($spdf,'D');


}
else{
  header('Location: regenerate.php?');
}
}
else{
  header('Location: regenerate.php');

}

}
else{
  header('Location: ./');
}

?>
